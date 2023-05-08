<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Membership" :link="route('membership.status')" icon="bi bi-person-bounding-box"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Sharing" :link="route('sharing.list')" icon="bi bi-share-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Shield" :link="route('shield.list')" icon="bi bi-shield-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Devices" :link="route('devices.list')" icon="bi bi-pc-display"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="History" :link="route('history.view')" icon="bi bi-clock-history"></x-maz-sidebar-item>
    {{-- <x-maz-sidebar-item name="Component" icon="bi bi-stack">
        <x-maz-sidebar-sub-item name="Accordion" :link="route('components.accordion')"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Alert" :link="route('components.alert')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item> --}}

</x-maz-sidebar>