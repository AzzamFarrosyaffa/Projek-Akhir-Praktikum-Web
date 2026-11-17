function hitungTotal() {
    const jenis = document.getElementById("jenis_tiket").value;
    const jumlahInput = document.getElementById("jumlah").value;
    const jumlah = jumlahInput ? parseInt(jumlahInput) : 0;
    
    const tampilTotal = document.getElementById("tampil_total");
    const inputTotalBayar = document.getElementById("total_bayar");

    let harga = 0;

    if (jenis === "Dewasa") {
        harga = 50000;
    } else if (jenis === "Anak") {
        harga = 35000;
    } else if (jenis === "Keluarga") {
        harga = 150000;
    }

    const total = harga * jumlah;

    tampilTotal.innerHTML = "Rp " + total.toLocaleString('id-ID');
    inputTotalBayar.value = total;
}

document.addEventListener("DOMContentLoaded", function () {
    const inputTanggal = document.querySelector('input[name="tanggal_kunjungan"]');
    
    if (inputTanggal) {
        const besok = new Date();
        besok.setDate(besok.getDate() + 1);

        const tahun = besok.getFullYear();
        const bulan = String(besok.getMonth() + 1).padStart(2, '0');
        const hari  = String(besok.getDate()).padStart(2, '0');

        inputTanggal.min = `${tahun}-${bulan}-${hari}`;
    }
});