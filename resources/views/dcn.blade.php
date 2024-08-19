@extends('layouts.main')

@section('container')
    <x-title.title>{{ $title }}</x-title.title>
    <x-alert.secondary fontWeight="normal">
        Hasil export bisa langsung di upload di SIMRS.
    </x-alert.secondary>
    @if (session()->has('success'))
        <x-alert.success fontSize="normal">
            {{ session('success') }}
        </x-alert.success>
    @endif
    <div class="mt-6">
        <a href="{{ route('dcn.export') }}">
            <x-button.info type="button" id="export">
                <i class="fa-solid fa-file-export me-1"></i>
                Export
            </x-button.info>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 mb-4 gap-y-2 gap-x-12">
        <div class="grid grid-cols-2 gap-2">
            <div class="flex justify-between col-span-1">Total Pencairan <span>:</span></div>
            <div class="col-span-1">Rp. {{ $dcnfpk['totalapproved'] }}</div>
            <div class="flex justify-between col-span-1">Total Piutang <span>:</span></div>
            <div class="col-span-1">Rp. {{ $dcnfpk['totalsubmitted'] }}</div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex justify-between col-span-1">Selisih <span>:</span></div>
            <div class="col-span-1">Rp. {{ $dcnfpk['totaldifference'] }}</div>
            <div class="flex justify-between col-span-1">Total Invoice <span>:</span></div>
            <div class="col-span-1">Rp. {{ $dcnfpk['totalinvoice'] }}</div>
        </div>
    </div>
    <div class="relative overflow-x-auto" id="tabel-data">
        <table class="w-full bg-gray-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No.SEP</th>
                    <th>Tgl. Verifikasi</th>
                    <th>Biaya Diajukan</th>
                    <th>Biaya Disetujui</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dcns as $index => $dcn)
                    <tr class="odd:bg-gray-50 even:bg-gray-100">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dcn->patsep }}</td>
                        <td>{{ $dcn->dcndateformat }}</td>
                        <td>{{ $dcn->totalsubmitted }}</td>
                        <td>{{ $dcn->totalapproved }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="col-span-5">Data masih kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
