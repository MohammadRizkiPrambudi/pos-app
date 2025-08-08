lucide.createIcons();

function showDetail(id) {
    const modal = document.getElementById("modalDetail");
    const content = document.getElementById("detailContent");
    content.innerHTML = `<p class="text-center text-gray-500">Memuat data...</p>`;
    console.log(id);

    fetch(`/riwayat-transaksi/${id}`)
        .then((res) => res.json())
        .then((data) => {
            let html = `
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

            data.items.forEach((item) => {
                html += `
                            <tr>
                                <td>${item.nama_barang}</td>
                                <td>${item.jumlah}</td>
                                <td>Rp${parseInt(item.harga).toLocaleString(
                                    "id-ID"
                                )}</td>
                                <td>Rp${parseInt(item.subtotal).toLocaleString(
                                    "id-ID"
                                )}</td>
                            </tr>
                        `;
            });

            html += `
                            </tbody>
                        </table>
                        <div class="mt-4 text-right font-bold">
                            Total: Rp${parseInt(data.total).toLocaleString(
                                "id-ID"
                            )}
                        </div>
                    `;

            content.innerHTML = html;
        })
        .catch((err) => {
            content.innerHTML = `<p class="text-red-500">Gagal memuat data.</p>`;
        });

    modal.showModal();
}
