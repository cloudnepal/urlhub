<div class="power-grid flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full w-full sm:px-6 lg:px-8">

            <div class="pg-header">
                @include($theme->layout->header, ['enabledFilters' => $enabledFilters])
            </div>

            @if(config('livewire-powergrid.filter') === 'outside')
                @if(count($makeFilters) > 0)
                    <div>
                        <x-livewire-powergrid::frameworks.tailwind.filter :makeFilters="$makeFilters"
                            :inputTextOptions="$inputTextOptions" :tableName="$tableName" :filters="$filters" :theme="$theme" />
                    </div>
                @endif
            @endif

            <div class="{{ $theme->table->divClass }}" style="{{ $theme->table->divStyle }}">
                @include($table)
            </div>

            <div class="pg-footer">
                @include($theme->footer->view)
            </div>
        </div>
    </div>
</div>
