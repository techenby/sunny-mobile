<div class="flex flex-col gap-6">
    <div>
        <flux:heading level="1" size="xl" class="text-center mb-2">Your household, organized</flux:heading>
        <flux:text size="lg" class="text-center">
            Sunny helps your family collaborate on recipes and keep track of what's in storage, all in one place.
        </flux:text>
    </div>

    <div class="flex items-center justify-center gap-3">
        <flux:button :href="route('register')" variant="primary">
            Get started
        </flux:button>
        <flux:button :href="route('login')" variant="ghost">
            Log in
        </flux:button>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        {{-- Recipes --}}
        <flux:card>
            <flux:avatar icon="book-open" icon-variant="outline" color="amber" class="mb-3" />
            <flux:heading size="lg">{{ __('Recipes') }}</flux:heading>
            <flux:text class="mt-1">
                {{ __('Save your favorite recipes, track ingredients, prep times, and nutrition info. Remix recipes to create your own variations.') }}
            </flux:text>
        </flux:card>

        {{-- Inventory --}}
        <flux:card>
            <flux:avatar icon="archive-box" icon-variant="outline" color="sky" class="mb-3" />
            <flux:heading size="lg">{{ __('Inventory') }}</flux:heading>
            <flux:text class="mt-1">
                {{ __('Organize your garage, basement, and pantry. Always know what you have and where it lives.') }}
            </flux:text>
        </flux:card>

        {{-- Teams --}}
        <flux:card>
            <flux:avatar icon="user-group" icon-variant="outline" color="violet" class="mb-3" />
            <flux:heading size="lg">{{ __('Teams') }}</flux:heading>
            <flux:text class="mt-1">
                {{ __('Invite family members to collaborate. Share recipes and inventory across your household with ease.') }}
            </flux:text>
        </flux:card>

        {{-- Dashboard --}}
        <flux:card>
            <flux:avatar icon="squares-2x2" icon-variant="outline" color="emerald" class="mb-3" />
            <div class="flex items-center gap-2">
                <flux:heading size="lg">{{ __('Dashboard') }}</flux:heading>
                <flux:badge size="sm" color="lime">{{ __('Soon') }}</flux:badge>
            </div>
            <flux:text class="mt-1">
                {{ __('A family homepage with shared calendars, weather updates, and more, all at a glance.') }}
            </flux:text>
        </flux:card>

        {{-- Collections --}}
        <flux:card>
            <flux:avatar icon="rectangle-stack" icon-variant="outline" color="pink" class="mb-3" />
            <div class="flex items-center gap-2">
                <flux:heading size="lg">{{ __('Collections') }}</flux:heading>
                <flux:badge size="sm" color="lime">{{ __('Soon') }}</flux:badge>
            </div>
            <flux:text class="mt-1">
                {{ __('Track collections outside of inventory like TCG cards, LEGO sets, and anything else you collect.') }}
            </flux:text>
        </flux:card>

        {{-- Budgeting --}}
        <flux:card>
            <flux:avatar icon="currency-dollar" icon-variant="outline" color="teal" class="mb-3" />
            <div class="flex items-center gap-2">
                <flux:heading size="lg">{{ __('Budgeting') }}</flux:heading>
                <flux:badge size="sm" color="lime">{{ __('Soon') }}</flux:badge>
            </div>
            <flux:text class="mt-1">
                {{ __('Connect your YNAB account to view budgets and track spending right from Sunny.') }}
            </flux:text>
        </flux:card>
    </div>
</div>
