<div class="grid gap-x-6 gap-y-5 md:grid-cols-2">
    <div>
        <x-admin.label for="name" />
        <x-admin.text-input
            autocomplete="off"
            name="name"
            required
            value="{{ $user->name }}"
            x-bind:disabled="disable"
        />
        <x-error name="name" />
    </div>
    <div>
        <x-admin.label for="email" />
        <x-admin.text-input
            autocomplete="off"
            name="email"
            required
            type="email"
            value="{{ $user->email }}"
            x-bind:disabled="disable"
        />
        <x-error name="email" />
    </div>
</div>

<fieldset>
    <x-admin.legend text="Permissions" />
    <div
        class="flex flex-wrap gap-x-6 gap-y-2 font-light"
        x-data="{ permissions: {{ json_encode($permissions) }} }"
    >
        @foreach ($permissions as $permission)
            <x-checkbox
                :cap="false"
                :value="$permission->id"
                class="h-4 w-4 rounded border-gray-300 disabled:text-gray-500"
                id="permission-{{ $permission->id }}"
                name="permissions[]"
                x-bind:checked="permissions[id].active || parent_active"
                x-bind:disabled="parent_active || disable"
                x-data="{
                    id: {{ $permission->id }},
                    get parent_active() { return Object.values(permissions).some((permission) => permission.active && permission.permissions.includes(this.id)) }
                }"
                x-on:click="permissions[id].active = !permissions[id].active"
            >
                <x-slot:label
                    class="gap-2"
                >
                    {{ $permission->name }}
                </x-slot:label>
            </x-checkbox>
        @endforeach
    </div>
    <x-error name="permissions.*" />
</fieldset>
