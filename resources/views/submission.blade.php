@extends('layouts.main')

@section('container')
    <x-title.title>Rawat Jalan / Bayi</x-title.title>
    <x-alert.secondary fontWeight="normal">
        Pilih file berisi data pengajuan dalam format xlsx, xls, ata csv. Pastikan header tabel berada di
        baris pertama supaya data dapat terbaca oleh sistem. Untuk lebih jelas bisa lihat di <a
            href="{{ route('submission.download') }}" class="text-blue-500">template</a> data klaim. Jika terjadi
        error, pindahkan tabel data klaim ke file excel yang baru.
    </x-alert.secondary>
    @if (session()->has('success'))
        <x-alert.success fontSize="normal">
            {{ session('success') }}
        </x-alert.success>
    @endif
    <x-alert.warning class="hidden alert-format">
        Pilih format file yang valid (xlsx, xls, atau csv).
    </x-alert.warning>
    <x-alert.warning class="hidden alert-gagal">
        Gagal menampilkan data.
    </x-alert.warning>
    <x-alert.warning class="hidden alert-kolom">
        Data <b id="header-nama"></b> tidak ada.
    </x-alert.warning>
    <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input.input type="file" name="file" id="file">File</x-input.input>
        <x-button.primary type="submit" id="simpan">Simpan</x-button.primary>
    </form>
    <div class="relative overflow-x-auto" id="tabel-data">
        <table class="w-full bg-gray-100">
            <thead id="tabel-head">
            </thead>
            <tbody id="tabel-body">
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script>
    <script>
        let file = document.querySelector('#file');
        let simpan = document.querySelector('#simpan');

        file.addEventListener("change", function() {
            let format = document.querySelector('.alert-format');
            let files = document.getElementById('file').files;

            format.classList.add('hidden');
            if (files.length == 0) {
                return;
            }
            let filename = files[0].name;
            let extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
            if (extension == '.XLS' || extension == '.XLSX' || extension == '.CSV') {
                excelFileToJSON(files[0]);
            } else {
                format.classList.remove('hidden');
            }
        });

        function excelFileToJSON(file) {
            let gagal = document.querySelector('.alert-gagal');
            gagal.classList.add('hidden');
            try {
                let reader = new FileReader();
                reader.readAsBinaryString(file);
                reader.onload = function(e) {
                    let data = e.target.result;
                    let workbook = XLSX.read(data, {
                        type: 'binary'
                    });
                    let result = {};
                    let firstSheetName = workbook.SheetNames[0];
                    let jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[firstSheetName]);
                    displayJsonToHtmlTable(jsonData);
                    cekHeader(jsonData);
                }
            } catch (e) {
                gagal.classList.remove('hidden');
            }
        }

        function cekHeader(jsonData) {
            let alertkolom = document.querySelector('.alert-kolom');
            let cekAtrributeSimpan = simpan.hasAttribute('disabled');
            if (!cekAtrributeSimpan) {
                simpan.setAttribute('disabled', '');
            }
            if (jsonData.length > 0) {
                let namaheader = document.querySelector('#header-nama');
                let header = Object.keys(jsonData[0]);
                let tglMasuk = header.includes('Tgl. Masuk');
                let tglPulang = header.includes('Tgl. Pulang');
                let noRM = header.includes('No. RM');
                let namaPasien = header.includes('Nama Pasien');
                let sep = header.includes('No. Klaim / SEP');
                let totalRajal = header.includes('Total Rajal');
                let totalBayi = header.includes('Total Bayi');
                namaheader.innerHTML = '';
                alertkolom.classList.add('hidden');

                appendColumn(tglMasuk, '[Tgl. Masuk]');
                appendColumn(tglPulang, '[Tgl. Pulang]');
                appendColumn(noRM, '[No. RM]');
                appendColumn(namaPasien, '[Nama Pasien]');
                appendColumn(sep, '[No. Klaim / SEP]');

                function appendColumn(column, message) {
                    if (!column) {
                        alertkolom.classList.remove('hidden');
                        namaheader.append(message + ' ');
                    }
                }
                if (tglMasuk && tglPulang && noRM && namaPasien && sep) {
                    simpan.removeAttribute('disabled');
                }
            } else {
                alertkolom.classList.add('hidden');
            }
        }

        function displayJsonToHtmlTable(jsonData) {
            let tabeldata = document.querySelector("#tabel-data");
            let tablehead = document.querySelector("#tabel-head");
            let tablebody = document.querySelector("#tabel-body");
            tabeldata.classList.add('mt-3');
            if (jsonData.length > 0) {
                let htmlDataHead =
                    '<tr><th>No</th><th>Tgl. Masuk</th><th>Tgl. Pulang</th><th>No. RM</th><th>Nama Pasien</th><th>No. Klaim / SEP</th><th>Total Rajal</th><th>Total Bayi</th></tr>';
                tablehead.innerHTML = htmlDataHead;
                let htmlData = ' ';
                jsonData.forEach((row, i) => {
                    htmlData += '<tr class="odd:bg-gray-50 even:bg-gray-100"><td>' + (i + 1) + '</td><td>' + row[
                            'Tgl. Masuk'] + '</td><td>' + row[
                            'Tgl. Pulang'] + '</td><td>' + row['No. RM'] + '</td><td>' + row['Nama Pasien'] +
                        '</td><td>' + row['No. Klaim / SEP'] + '</td><td>' + (row['Total Rajal'] ?? 0) +
                        '</td><td>' + (row['Total Bayi'] ?? 0) + '</td></tr>';
                });
                tablebody.innerHTML = htmlData;
            } else {
                tablehead.innerHTML = '';
                tablebody.innerHTML = '<td class="text-center">Tidak ada data yang ditemukan di dalam file</td>';
            }
        }
    </script>
@endpush
