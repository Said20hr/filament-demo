<?php

namespace Database\Seeders;

use App\Filament\Resources\Shop\OrderResource;
use App\Models\Address;
use App\Models\Blog\Author;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Blog\Link;
use App\Models\Blog\Post;
use App\Models\Comment;
use App\Models\Shop\Brand;
use App\Models\Shop\Category as ShopCategory;
use App\Models\Shop\Customer;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Payment;
use App\Models\Shop\Product;
use App\Models\User;
use Closure;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

        // Clear images
        Storage::deleteDirectory('public');
        // Roles
        $this->command->warn(PHP_EOL . 'Creating roles...');
        $roles = ['Admin', 'Moderator', 'User'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        $this->command->info('Roles created.');

        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $admin = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
        ]));
        $moderator = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Moderator',
            'email' => 'moderator@demo.com',
        ]));
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'User',
            'email' => 'user@demo.com',
        ]));
        $admin->first()->assignRole('Admin');
        $moderator->first()->assignRole('Moderator');
        $user->first()->assignRole('User');
        $this->command->info('Admin user created.');
        $this->command->info('Moderator user created.');
        $this->command->info('User user created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection;

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
