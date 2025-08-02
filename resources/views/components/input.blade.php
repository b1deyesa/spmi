<div class="flex flex-col gap-1 w-full">
    
    @if ($label)
        <label class="text-[.9em] text-gray-500">{{ $label }} @if($required) <span class="text-red-400">*</span> @endif</label>
    @endif
    
    @if ($type == 'data-list')
        <div x-data="{o:@js($options),q:'{{ $options[old($name, $value)] ?? null }}',k:'{{ old($name, $value) }}',f(){return Object.entries(this.o).filter(([_,v])=>v.toLowerCase().includes(this.q.toLowerCase()))},c(){let m=Object.entries(this.o).find(([_,v])=>v.toLowerCase()===this.q.toLowerCase());this.k=m?m[0]:'',this.q=m?m[1]:''}}" class="relative">
            <input type="hidden" name="{{ $name }}" :value="k">
            <input type="text" x-model="q" @input="$refs.l.hidden=false" @focus="$refs.l.hidden=false" @blur="c();$refs.l.hidden=true" placeholder="{{ $placeholder }}" class="border rounded-sm px-3 py-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror">
            <ul x-ref="l" hidden class="absolute bg-gray-600 text-white border border-gray-300 rounded-sm mt-1 w-full max-h-40 overflow-y-auto z-10">
                <template x-for="[key,val] in f()" :key="key">
                    <li @mousedown.prevent="k=key;q=val;$refs.l.hidden=true" class="px-3 py-2 hover:bg-gray-500 cursor-pointer" x-text="val"></li>
                </template>
            </ul>
        </div>
    @elseif ($type == 'data-list-wire')
        <div x-data="{options:@js($options),q:@entangle($wire),k:@entangle($wire),filtered(){return Object.entries(this.options).filter(([_,v])=>v.toLowerCase().includes(this.q.toLowerCase()))},choose(key,val){this.k=key;this.q=val;$refs.list.hidden=true;$wire.set('{{ $wire }}',key)},blurHandler(){let f=Object.entries(this.options).find(([_,v])=>v.toLowerCase()===this.q.toLowerCase());f?(this.k=f[0],this.q=f[1],$wire.set('{{ $wire }}',f[0])):$wire.set('{{ $wire }}',this.q);$refs.list.hidden=true}}" class="relative">
            <input type="text" x-model="q" @input="$refs.list.hidden=false" @focus="$refs.list.hidden=false" @blur="blurHandler" placeholder="{{ $placeholder }}" class="border rounded-sm px-3 py-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror">
            <ul x-ref="list" hidden class="absolute bg-white shadow border border-gray-200 mt-1 w-full max-h-40 overflow-y-auto z-10">
                <template x-for="[key,val] in filtered()" :key="key">
                    <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer" @mousedown.prevent="choose(key,val)" x-text="val"></li>
                </template>
            </ul>
        </div>
    @elseif ($type == 'multiple-list')
        <div x-data="{o:@js($options),q:'',k:@js(old($name, $value ?: [])),f(){return Object.entries(this.o).filter(([key,val])=>val.toLowerCase().includes(this.q.toLowerCase())&&!this.k.includes(Number(key)))},c(){let m=Object.entries(this.o).find(([key,val])=>val.toLowerCase()===this.q.toLowerCase());if(m&&!this.k.includes(Number(m[0]))){this.k.push(Number(m[0]));this.q=''}},remove(index){this.k.splice(index,1)}}" class="relative">
            <template x-for="(item,i) in k" :key="i"><input type="hidden" name="{{ $name }}[]" :value="item"></template>
            <input type="text" x-model="q" @input="$refs.l.hidden=false" @focus="$refs.l.hidden=false" @blur="c();$refs.l.hidden=true;$refs.input.blur()" placeholder="{{ $placeholder }}" class="border rounded-sm px-3 py-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror" x-ref="input">
                <ul x-ref="l" hidden class="absolute bg-gray-600 text-white border border-gray-300 rounded-sm mt-1 w-full max-h-40 overflow-y-auto z-10">
                    <template x-for="[key,val] in f()" :key="key"><li @mousedown.prevent="q=val;c();$refs.l.hidden=true;$refs.input.blur()" class="px-3 py-2 hover:bg-gray-500 cursor-pointer" x-text="val"></li></template>
                </ul>
            <div x-show="k.length>0" class="mt-2 flex flex-col gap-1">
                <template x-for="(item,index) in k" :key="index"><span class="inline-block text-gray-200 bg-gray-500 px-4 py-1 rounded-full text-[13px] w-fit"><span x-text="o[item]"></span><button type="button" @click="remove(index)" class="ml-2 text-red-200"><i class="fa-solid fa-xmark"></i></button></span></template>
            </div>
        </div>   
    @elseif ($type == 'textarea')
        <textarea name="{{ $name }}" placeholder="{{ $placeholder }}" @if($wire) wire:model.live="{{ $wire }}" @endif class="border rounded-sm px-3 py-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror" @disabled($disabled) cols="{{ $cols }}" rows="{{ $rows }}">{{ old($name, $value) }}</textarea>
    @elseif ($type == 'file')
        <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" @if($wire) wire:model.live="{{ $wire }}" @endif value="{{ old($name, $value) }}" autocomplete="off" class="border rounded-sm pr-3 file:bg-gray-200 file:cursor-pointer file:mr-3 file:text-gray-600 file:p-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror">
    @else
        <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" @if($wire) wire:model.live="{{ $wire }}" @endif value="{{ old($name, $value) }}" autocomplete="off" class="border rounded-sm px-3 py-2 border-gray-300 bg-gray-50 w-full placeholder:text-zinc-300 {{ $class }} @error($name) border-red-300 @enderror" @disabled($disabled)>
    @endif
    
    @error($name)
        <div class="text-xs text-red-400">{{ $message }}</div>
    @enderror
    
</div>