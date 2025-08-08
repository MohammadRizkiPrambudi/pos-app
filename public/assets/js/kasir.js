lucide.createIcons();

let keranjang = [];

function tambahBarang() {
    let kode = document.getElementById("kode_barang").value.trim();
    if (!kode) return alert("Masukkan kode barang");

    fetch(`/api/barang/${kode}`)
        .then((res) => res.json())
        .then((data) => {
            if (data.message !== "success") {
                alert("Barang tidak ditemukan");
                return;
            }

            let barang = data.data;
            let existing = keranjang.find((i) => i.id === barang.id);

            if (existing) {
                existing.jumlah++;
            } else {
                keranjang.push({
                    id: barang.id,
                    nama: barang.nama_barang,
                    harga: barang.harga,
                    jumlah: 1,
                });
            }

            document.getElementById("kode_barang").value = "";
            renderKeranjang();
        });
}

function renderKeranjang() {
    let tbody = document.getElementById("keranjang-body");
    tbody.innerHTML = "";
    let total = 0;

    keranjang.forEach((item, index) => {
        let subtotal = item.harga * item.jumlah;
        total += subtotal;

        tbody.innerHTML += `
                    <tr>
                        <td>${item.nama}</td>
                        <td>Rp${item.harga}</td>
                        <td>
                            <input type="number" min="1" value="${item.jumlah}"
                                class="input input-bordered w-20"
                                onchange="ubahJumlah(${index}, this.value)">
                        </td>
                        <td>Rp${subtotal}</td>
                        <td>
                            <button type="button" onclick="hapusItem(${index})" class="btn btn-error btn-xs">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                `;
    });

    document.getElementById("total_harga").innerText = total;
    document.getElementById("items_json").value = JSON.stringify(keranjang);
    lucide.createIcons();
}

function ubahJumlah(index, qty) {
    keranjang[index].jumlah = parseInt(qty);
    renderKeranjang();
}

function hapusItem(index) {
    keranjang.splice(index, 1);
    renderKeranjang();
}

setTimeout(() => {
    const alert = document.getElementById("alert");
    if (alert) alert.remove();
}, 3000);
