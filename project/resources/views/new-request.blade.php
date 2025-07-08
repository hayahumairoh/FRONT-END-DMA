@extends('layout.layout')

<head>
    <meta charset="UTF-8">
    <title>New Request</title>
    <link rel="stylesheet" href="{{ asset('css/new-request.css') }}">

    <script>
        const dummyRequestorData = {
            "1234567890": {
                nama: "Budi Santoso",
                email: "budi.santoso@example.com",
                jabatan: "Manager Data",
                bidang: "Bidang Teknologi",
                // inisial_bidang: "BT",
                divisi: "Divisi TI"
            },
            "2345678901": {
                nama: "Siti Aminah",
                email: "siti.aminah@example.com",
                jabatan: "Staf Admin",
                bidang: "Bidang Keuangan",
                // inisial_bidang: "BK",
                divisi: "Divisi Finance"
            },
            "3456789012": {
                nama: "Andi Wijaya",
                email: "andi.wijaya@example.com",
                jabatan: "Data Analyst",
                bidang: "Bidang Analis",
                // inisial_bidang: "BA",
                divisi: "Divisi Riset"
            }
        };

        const dummyPJUData = {
            "8880001111": {
                nama: "Ir. Hasan Fauzi",
                jabatan: "Direktur Riset",
                bidang: "Bidang Strategi"
            },
            "7770002222": {
                nama: "Dr. Indah Sari",
                jabatan: "Kepala Divisi Operasional",
                bidang: "Bidang Operasi"
            },
            "6660003333": {
                nama: "Ahmad Ridwan",
                jabatan: "Manajer Keuangan",
                bidang: "Bidang Keuangan"
            }
        };

        function toggleForm() {
            const radioYes = document.querySelector('input[name="divi_account"][value="yes"]');
            const radioNo = document.querySelector('input[name="divi_account"][value="no"]');
            const formSudah = document.getElementById('sudah-divi-form');
            const formBelum = document.getElementById('divi-form-section');

            if (radioYes.checked) {
                formSudah.style.display = 'block';
                formBelum.style.display = 'none';
            } else if (radioNo.checked) {
                formSudah.style.display = 'none';
                formBelum.style.display = 'block';
            } else {
                formSudah.style.display = 'none';
                formBelum.style.display = 'none';
            }
        }

        function validateDiviAccountNIK() {
            const nikInput = document.getElementById('nik_verifikasi');
            const errorMsg = document.getElementById('nik-verifikasi-error');
            const successMsg = document.getElementById('nik-verifikasi-success');
            const submitBtn = document.getElementById('submit-btn-sudah');
            const grantBtn = document.getElementById('grant-btn-sudah');

            const nik = nikInput.value.trim();
            const data = dummyRequestorData[nik];

            if (!data) {
                errorMsg.style.display = 'block';
                successMsg.style.display = 'none';

                submitBtn.disabled = true;
                grantBtn.disabled = true;

                submitBtn.classList.add('disabled');
                grantBtn.classList.add('disabled');
            } else {
                errorMsg.style.display = 'none';
                successMsg.style.display = 'block';

                // Submit tetap tidak aktif
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');

                // Grant Data aktif
                grantBtn.disabled = false;
                grantBtn.classList.remove('disabled');
            }
        }


        function validateRequestorNIK() {
            const nikInput = document.getElementById('nik');
            const errorMsg = document.getElementById('nik-error');
            const submitBtn = document.getElementById('submit-btn-belum');
            const grantBtn = document.getElementById('grant-btn-belum');

            const nik = nikInput.value.trim();
            const data = dummyRequestorData[nik];

            if (!data) {
                errorMsg.style.display = 'block';
                submitBtn.disabled = true;
                grantBtn.disabled = true;
                submitBtn.classList.add('disabled');
                grantBtn.classList.add('disabled');
            } else {
                errorMsg.style.display = 'none';
                submitBtn.disabled = false;
                grantBtn.disabled = false;
                submitBtn.classList.remove('disabled');
                grantBtn.classList.remove('disabled');
            }
        }

        function toggleRecipientForm(radio = null) {
            const isPersonal = radio ? radio.value === 'Personal' : false;
            const form = radio ? radio.closest('.recipient-form') : null;

            if (form) {
                const personal = form.querySelector('.personal-form-section');
                const aplikasi = form.querySelector('.aplikasi-form-section');

                if (personal && aplikasi) {
                    personal.style.display = isPersonal ? 'block' : 'none';
                    aplikasi.style.display = isPersonal ? 'none' : 'block';
                }
            }
        }


        function addRecipient() {
            const container = document.getElementById('recipient-container');
            const index = document.querySelectorAll('.recipient-form').length + 1;

            const html = `
            <div class="form-card recipient-form" id="recipient-${index}" style="margin-top: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4>Recipient ${index}</h4>
                    <button type="button" class="gray-btn" onclick="removeRecipient('recipient-${index}')">Hapus</button>
                </div>

                <div class="field-grid">
                    <label>Request User Apa</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="UserType${index}" value="Personal" onclick="toggleRecipientForm(this)">
                            <span class="radio-circle"></span> Personal
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="UserType${index}" value="Aplikasi" onclick="toggleRecipientForm(this)">
                            <span class="radio-circle"></span> Aplikasi
                        </label>
                    </div>
                </div>

                <div class="personal-form-section" style="display: none;">
                    <div class="field-grid">
                        <label>Status Pegawai</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="Status${index}" value="Organic">
                                <span class="radio-circle"></span> Organic
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="Status${index}" value="Non-Organic">
                                <span class="radio-circle"></span> Non-Organic
                            </label>
                        </div>

                        <label>Recipient</label>
                        <div class="checkbox-group">
                            <label class="checkbox-option">
                                <input type="checkbox" name="Sama${index}" value="Requestor" onclick="copyRequestorDataToRecipient(this)">
                                <span class="checkbox-box"></span> Sama seperti Requestor
                            </label>
                        </div>

                        <label for="nik">NIK</label>
                        <input list="nik-options" name="nik${index}" placeholder="Masukkan NIK">

                        <label>Nama Lengkap</label>
                        <input type="text" name="nama${index}">

                        <label>Email</label>
                        <input type="email" name="email${index}">

                        <label>Jabatan</label>
                        <input type="text" name="jabatan${index}">

                        <label>Bidang</label>
                        <input type="text" name="bidang${index}">

                        <label>Inisial Bidang</label>
                        <input type="text" name="inisial_bidang${index}" placeholder="min. 3 huruf">

                        <label>Divisi / Sub-Direktorat</label>
                        <input type="text" name="divisi${index}">
                    </div>
                </div>

                <div class="aplikasi-form-section" style="display: none;">
                    <div class="field-grid">
                        <label>Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi${index}">

                        <label>IP/URL Aplikasi</label>
                        <input type="text" name="url_aplikasi${index}">
                    </div>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeRecipient(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        function autofillRequestor() {
            const nik = document.getElementById('nik').value.trim();
            const data = dummyRequestorData[nik];

            if (data) {
                document.getElementById('nama_requestor').value = data.nama;
                document.getElementById('email_requestor').value = data.email;
                document.getElementById('jabatan_requestor').value = data.jabatan;
                document.getElementById('bidang_requestor').value = data.bidang;
                // document.getElementById('inisial_bidang_requestor').value = data.inisial_bidang;
                document.getElementById('divisi_requestor').value = data.divisi;

                ['nama_requestor', 'email_requestor', 'jabatan_requestor', 'bidang_requestor', 'divisi_requestor'].forEach(id => {
                    document.getElementById(id).readOnly = true;
                });
                document.getElementById('inisial_bidang_requestor').readOnly = false;
            } else {
                ['nama_requestor', 'email_requestor', 'jabatan_requestor', 'bidang_requestor', 'divisi_requestor'].forEach(id => {
                    const el = document.getElementById(id);
                    el.value = '';
                    el.readOnly = false;
                });

                const inisial = document.getElementById('inisial_bidang_requestor');
                inisial.value = '';
                inisial.readOnly = false;
            }
        }

        function autofillPJU() {
            const nik = document.getElementById('nik_pju').value.trim();
            const data = dummyPJUData[nik];

            const nama = document.getElementById('nama_pju');
            const jabatan = document.getElementById('jabatan_pju');
            const bidang = document.getElementById('bidang_pju');

            if (data) {
                nama.value = data.nama;
                jabatan.value = data.jabatan;
                bidang.value = data.bidang;

                nama.readOnly = true;
                jabatan.readOnly = true;
                bidang.readOnly = true;
            } else {
                nama.value = '';
                jabatan.value = '';
                bidang.value = '';

                nama.readOnly = false;
                jabatan.readOnly = false;
                bidang.readOnly = false;
            }
        }

        function copyRequestorDataToRecipient(checkbox) {
            const form = checkbox.closest('.recipient-form');
            const isChecked = checkbox.checked;

            const requestorData = {
                nik: document.getElementById('nik').value,
                nama: document.getElementById('nama_requestor').value,
                email: document.getElementById('email_requestor').value,
                jabatan: document.getElementById('jabatan_requestor').value,
                bidang: document.getElementById('bidang_requestor').value,
                inisial: document.getElementById('inisial_bidang_requestor').value,
                divisi: document.getElementById('divisi_requestor').value
            };

            if (form) {
                form.querySelectorAll('input').forEach(input => {
                    const name = input.name.toLowerCase();
                    if (isChecked) {
                        if (name.includes('nik')) input.value = requestorData.nik;
                        if (name.includes('nama') && !name.includes('pju')) input.value = requestorData.nama;
                        if (name.includes('email')) input.value = requestorData.email;
                        if (name.includes('jabatan')) input.value = requestorData.jabatan;
                        if (name.includes('bidang') && !name.includes('pju') && !name.includes('inisial')) input.value = requestorData.bidang;
                        if (name.includes('inisial_bidang')) input.value = requestorData.inisial;
                        if (name.includes('divisi')) input.value = requestorData.divisi;
                    } else {
                        if (!name.includes('sama')) {
                            input.value = '';
                        }
                    }
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('nik').addEventListener('change', autofillRequestor);
            document.getElementById('nik_pju').addEventListener('change', autofillPJU);
        });
    </script>
</head>

@section('content')
<body>
    <h1 class="page-title">New Request</h1>

    <div class="form-card">
        <label class="question"><strong>Sudah punya akun Divi (Denodo)?</strong></label>
        <div class="radio-group">
            <label class="radio-option">
                <input type="radio" name="divi_account" value="yes" onclick="toggleForm()">
                <span class="radio-circle"></span> Yes
            </label>
            <label class="radio-option">
                <input type="radio" name="divi_account" value="no" onclick="toggleForm()">
                <span class="radio-circle"></span> No
            </label>
        </div>
    </div>

    <!-- Form untuk Sudah Punya Akun -->
    <div class="form-card" id="sudah-divi-form" style="display: none;">
        <h4>Verifikasi Akun Divi</h4>
        <div class="field-grid">
    <label for="nik_verifikasi">NIK</label>
    <div>
        <div class="nik-search-wrapper">
            <input type="text" id="nik_verifikasi" name="nik_verifikasi" placeholder="Masukkan NIK">
            <button class="search-btn" onclick="validateDiviAccountNIK()">🔍</button>
        </div>
        <div class="status-message-wrapper">
            <div id="nik-verifikasi-error" class="error-message">Akun tidak tersedia</div>
            <div id="nik-verifikasi-success" class="success-message">Akun tersedia</div>
        </div>
    </div>
    </div>

        <div class="button-row" style="margin-top: 30px;">
            <button class="gray-btn">Cancel</button>
            <button class="gray-btn">Save Draft</button>
            <button class="black-btn" id="submit-btn-sudah">Submit</button>
            <button class="gray-btn" id="grant-btn-sudah">Request Grant Data</button>
        </div>
    </div>

    <!-- Form untuk Belum Punya Akun -->
    <div class="form-card" id="divi-form-section" style="display: none;">
        <h3>Request User DiVi Form</h3>
        <hr class="section-divider">

        <h4>Data Requestor</h4>
        <hr class="section-divider">
        <div class="field-grid">
            <label for="nik">NIK</label>
            <input list="nik-options" id="nik" name="nik" placeholder="Masukkan NIK">
            <datalist id="nik-options">
                <option value="1234567890">
                <option value="2345678901">
                <option value="3456789012">
            </datalist>

            <label>Nama Lengkap</label>
            <input type="text" id="nama_requestor" name="nama_requestor" readonly>

            <label>Email</label>
            <input type="email" id="email_requestor" name="email_requestor" readonly>

            <label>Jabatan</label>
            <input type="text" id="jabatan_requestor" name="jabatan_requestor" readonly>

            <label>Bidang</label>
            <input type="text" id="bidang_requestor" name="bidang_requestor" readonly>

            <label>Inisial Bidang</label>
            <input type="text" id="inisial_bidang_requestor" name="inisial_bidang_requestor" placeholder="min. 3 huruf">

            <label>Divisi / Sub-Direktorat</label>
            <input type="text" id="divisi_requestor" name="divisi_requestor" readonly>

            <label>Kebutuhan Permintaan</label>
            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="kebutuhan" value="operasional">
                    <span class="radio-circle"></span> Operasional
                </label>
                <label class="radio-option">
                    <input type="radio" name="kebutuhan" value="usecase">
                    <span class="radio-circle"></span> Use Case
                </label>
            </div>

            <label>Alasan Detail Permintaan</label>
            <textarea class="textarea-full" placeholder="Masukkan Alasan"></textarea>
        </div>

        <hr class="section-divider">
        <h4>Data Recipient</h4>
        <hr class="section-divider">
        <button type="button" class="gray-btn" onclick="addRecipient()">+ Tambah Recipient</button>
        <div id="recipient-container"></div>

        <hr class="section-divider">
        <h4>Data Penanggung Jawab User</h4>
        <hr class="section-divider">
        <div class="field-grid">
            <label for="nik_pju">NIK PJU</label>
            <input list="nik-pju-options" id="nik_pju" name="nik_pju" placeholder="Masukkan NIK PJU">
            <datalist id="nik-pju-options">
                <option value="8880001111">
                <option value="7770002222">
                <option value="6660003333">
            </datalist>

            <label for="nama_pju">Nama PJU</label>
            <input type="text" id="nama_pju" name="nama_pju" readonly>

            <label for="jabatan_pju">Jabatan PJU</label>
            <input type="text" id="jabatan_pju" name="jabatan_pju" readonly>

            <label for="bidang_pju">Bidang PJU</label>
            <input type="text" id="bidang_pju" name="bidang_pju" readonly>
        </div>

        <div class="button-row">
            <button class="gray-btn">Cancel</button>
            <button class="gray-btn">Save Draft</button>
            <button class="black-btn">Submit</button>
            <button class="gray-btn">Request Grant Data</button>
        </div>
    </div>
</body>
@endsection