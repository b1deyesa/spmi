<tr>
    <td class="p-2 border-b border-gray-200">{{ $fakultas_kebijakan->kebijakan->nama }}</td>
    <td class="p-2 border-b border-gray-200">
        <div class="flex flex-col" x-data="{ open: false }">
            <label class="flex gap-2" for="status_pengaturan_1_{{ $fakultas_kebijakan->id }}">
                <div class="modal" x-show="open" x-cloak>
                    <div class="modal-container w-[500px] p-4 py-6">
                        <div class="flex flex-col gap-5">
                            <h3 class="text-md font-bold">{{ $fakultas_kebijakan->kebijakan->nama }}</h3>
                            <hr class="border-gray-200">
                            <form wire:submit="submit" class="flex flex-col gap-5 px-3">
                                <x-input type="text" label="Catatan" wire="catatan" />
                                <x-input type="date" label="Tanggal Ditetapkan" wire="tanggal_ditetapkan" />
                                <hr class="border-dashed border-gray-200">
                                <div class="flex flex-col gap-2">
                                    <small class="flex text-xs py-3 px-4 rounded-md bg-amber-100">Catatan: Pastikan link/tautan yang diberikan dapat diakses/dibaca oleh publik! (General Access: Anyone With The Link)</small>
                                    <x-input type="text" label="Tautan" wire="tautan" />
                                </div>
                                <div class="flex gap-2 justify-end mt-5">
                                    <button type="button" onclick="window.location.reload();" class="flex justify-center min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Batal</button>
                                    <button type="submit" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm bg-gray-700 text-zinc-50">Submit</button>        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <input type="radio" wire:model.live="status_pengaturan.{{ $fakultas_kebijakan->id }}" id="status_pengaturan_1_{{ $fakultas_kebijakan->id }}" value="1" name="status_pengaturan-{{ $fakultas_kebijakan->id }}" x-on:click="open = true">Ada
            </label for="status_pengaturan_0_{{ $fakultas_kebijakan->id }}">
            <label class="flex gap-2">
                <input type="radio" wire:model.live="status_pengaturan.{{ $fakultas_kebijakan->id }}" wire:click="removeStatusPengaturan()" id="status_pengaturan_0_{{ $fakultas_kebijakan->id }}" value="0" name="status_pengaturan-{{ $fakultas_kebijakan->id }}">Tidak Ada
            </label>
        </div>
    </td>
    @if ($fakultas_kebijakan->tautan)
        <td class="p-2 border-b border-gray-200" align="center"><a href="{{ $fakultas_kebijakan->tautan }}" target="_blank" class="flex items-center w-fit gap-1 text-xs py-1 px-3 rounded-md bg-gray-700 text-gray-50"><i class="fa-solid fa-link"></i>Link</a></td>
        <td class="p-2 border-b border-gray-200" align="center">{{ \Carbon\Carbon::parse($fakultas_kebijakan->tanggal_ditetapkan)->translatedFormat('d F Y') }}</td>
        <td class="p-2 border-b border-gray-200" align="center">
            @if ($fakultas_kebijakan->status_verifikasi == '1')    
                <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-green-500 text-zinc-50" style="font-size: .75em; width: fit-content">
                    <i class="fa-solid fa-circle-check"></i>Terverifikasi
                </span>
            @else
                <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-blue-200 text-zinc-800" style="font-size: .75em; width: fit-content">
                    Belum Terverifikasi
                </span>
            @endif
        </td>
        <td class="p-2 border-b border-gray-200" align="center">
            @if ($fakultas_kebijakan->status_dokumen == '1')    
                <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-green-500 text-zinc-50" style="font-size: .75em; width: fit-content">
                    <i class="fa-solid fa-circle-check"></i>Dokumen Diverifikasi
                </span>
            @else
                <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-gray-300 text-zinc-800" style="font-size: .75em; width: fit-content">
                    Dokumen Belum Diverifikasi
                </span>
            @endif
        </td>
        <td class="p-2 border-b border-gray-200">
            <div class="flex items-center gap-1">
                <div x-data="{ open: false }">
                    <button type="button" x-on:click="open = true" class="flex items-center w-fit gap-1 text-sm p-2 rounded-md bg-sky-700 text-gray-50"><i class="fas fa-pencil"></i></button>
                    <div class="modal" x-show="open" x-cloak>
                        <div class="modal-container w-[500px] p-4 py-6">
                            <div class="flex flex-col gap-5">
                                <h3 class="text-md font-bold">{{ $fakultas_kebijakan->kebijakan->nama }}</h3>
                                <hr class="border-gray-200">
                                <form wire:submit="submit" class="flex flex-col gap-5 px-3">
                                    <x-input type="text" label="Catatan" wire="catatan" />
                                    <x-input type="date" label="Tanggal Ditetapkan" wire="tanggal_ditetapkan" />
                                    <hr class="border-dashed border-gray-200">
                                    <div class="flex flex-col gap-2">
                                        <small class="flex text-xs py-3 px-4 rounded-md bg-amber-100">Catatan: Pastikan link/tautan yang diberikan dapat diakses/dibaca oleh publik! (General Access: Anyone With The Link)</small>
                                        <x-input type="text" label="Tautan" wire="tautan" />
                                    </div>
                                    <div class="flex gap-2 justify-end mt-5">
                                        <button type="button" onclick="window.location.reload();" class="flex justify-center min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Batal</button>
                                        <button type="submit" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm bg-gray-700 text-zinc-50">Submit</button>        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false }">
                    <button type="button" x-on:click="open = true" class="flex items-center w-fit gap-1 text-sm p-2 rounded-md bg-blue-700 text-gray-50"><i class="fas fa-eye"></i></button>
                    <div class="modal" x-show="open" x-cloak>
                        <div class="modal-container w-[800px] p-4 py-6">
                            <div class="flex flex-col gap-5">
                                <h3 class="text-md font-bold">{{ $fakultas_kebijakan->kebijakan->nama }}</h3>
                                <hr class="border-gray-200">
                                <div class="px-2">
                                    <table>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Nama UPPS</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">{{ $fakultas_kebijakan->fakultas->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Status Pengaturan</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                <div class="flex items-center gap-2">
                                                    {{ $fakultas_kebijakan->status_pengaturan ? 'Ada' : 'Tidak' }}
                                                    {!! $fakultas_kebijakan->status_pengaturan ? '<i class="fa-solid fa-check-circle text-green-500"></i>' : '<i class="fa-solid fa-xmark-circle text-red-500"></i>' !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Catatan PT</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">{{ $fakultas_kebijakan->catatan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Tautan</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;"><div class="flex flex-wrap gap-2">{{ $fakultas_kebijakan->tautan }}<a href="{{ $fakultas_kebijakan->tautan }}" target="_blank" class="flex items-center w-fit gap-1 text-xs py-1 px-2 rounded-md bg-gray-700 text-gray-50"><i class="fa-solid fa-link"></i></a></div></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Status Ajuan</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                @if ($fakultas_kebijakan->status_verifikasi == '1')    
                                                    <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-green-500 text-zinc-50" style="font-size: .75em; width: fit-content">
                                                        <i class="fa-solid fa-circle-check"></i>Terverifikasi
                                                    </span>
                                                @else
                                                    <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-blue-200 text-zinc-800" style="font-size: .75em; width: fit-content">
                                                        Belum Terverifikasi
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Status Dokumen</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                @if ($fakultas_kebijakan->status_dokumen == '1')    
                                                    <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-green-500 text-zinc-50" style="font-size: .75em; width: fit-content">
                                                        <i class="fa-solid fa-circle-check"></i>Terverifikasi
                                                    </span>
                                                @else
                                                    <span class="text-xs flex gap-2 items-center justify-center px-2 py-1 rounded-full bg-blue-200 text-zinc-800" style="font-size: .75em; width: fit-content">
                                                        Belum Terverifikasi
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Tanggal Ditetapkan</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                {{ \Carbon\Carbon::parse($fakultas_kebijakan->tanggal_ditetapkan)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-1" style="vertical-align: top" width="150px">Tanggal Dibuat</td>
                                            <td class="py-2 px-1" style="vertical-align: top">:</td>
                                            <td class="py-2 px-1" style="vertical-align: top; overflow-wrap: break-word; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                {{ \Carbon\Carbon::parse($fakultas_kebijakan->create_at)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="flex gap-2 justify-end mt-5">
                                        <button type="button" onclick="window.location.reload();" class="flex justify-center min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    @else 
        <td class="p-2 border-b border-gray-200" colspan="5"><small class="flex justify-center px-3 py-1 rounded-full w-full text-gray-300">Belum diisi</small></td>
    @endif
</tr>