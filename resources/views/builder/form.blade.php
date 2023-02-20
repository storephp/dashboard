<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{ $pagePretitle ?? 'Pretitle' }}
                    </div>
                    <h2 class="page-title">
                        {{ $meta['pageTitle'] ?? 'title' }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <form class="card" wire:submit.prevent="submit">
                <div class="row g-0">
                    <div class="col-3 d-none d-md-block border-end">
                        <div class="card-body">
                            <h4 class="subheader">Tabs</h4>
                            <div class="list-group list-group-transparent">
                                @foreach ($from_tabs as $from_tab)
                                    <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center @if ($from_tab['id'] == $tab) active @endif"
                                        wire:click="setTab('{{ $from_tab['id'] }}')">{{ $from_tab['name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column">

                        @foreach ($from_tabs as $from_tab)
                            @if ($tab == $from_tab['id'])
                                <div class="card-body">
                                    <h2 class="mb-4">{{ $from_tab['name'] }}</h2>
                                    @foreach ($from_tab['fields'] as $field)
                                        @if ($field['type'] == 'select')
                                            <x-outmart-select label="{{ $field['label'] }}"
                                                model="{{ $field['model'] }}" :options="$field['options']" :hint="$field['hint']" />
                                        @endif

                                        @if ($field['type'] == 'text')
                                            <x-outmart-input-text label="{{ $field['label'] }}"
                                                model="{{ $field['model'] }}" :hint="$field['hint']" />
                                        @endif
                                    @endforeach

                                </div>
                            @endif
                        @endforeach


                        {{-- @if ($tab == 'dd')
                            <div class="card-body">
                                <h2 class="mb-4">Basic info dd</h2>
                                @foreach ($fileds as $filed)
                                    @if ($filed['type'] == 'text')
                                        <x-outmart-input-text label="{{ $filed['label'] }}" model="{{ $filed['model'] }}" />
                                    @endif
                                @endforeach
                            </div>
                        @endif --}}

                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="#" class="btn">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">{{ $meta['submitLabel'] ?? 'Submit' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
