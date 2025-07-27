{{-- resources/views/livewire/map.blade.php --}}

{{-- Hapus kelas grid, col-span, dan gap dari div root. Biarkan hanya wire:ignore.
     Ini akan memastikan div ini menghormati padding dan layout bawaan Filament. --}}
<div wire:ignore>
    {{-- Div ini tetap bertanggung jawab untuk styling kartu putih dan padding internal --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        {{-- Map container Anda --}}
        <div id="map" class="w-full" style="height: 75vh;"></div>
    </div>

    {{-- Link CSS Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    {{-- Script JS Leaflet --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        /* CSS tambahan untuk memastikan Leaflet tidak menindih. */
        /* Ini menargetkan container yang dibuat oleh Leaflet. */
        .leaflet-container {
            /* Pastikan tidak ada posisi absolut atau z-index tinggi yang tidak diinginkan */
            position: relative !important;
            z-index: 1; /* Nilai rendah untuk mencegah penindihan UI Filament */
            overflow: hidden; /* Mencegah konten keluar dari batas peta */
        }

        /* Opsional: Sesuaikan tinggi/lebar jika ada masalah di beberapa kasus,
           tapi 75vh pada id="map" seharusnya sudah cukup */
        #map {
            /* Pastikan tidak ada margin negatif yang mungkin mendorong peta ke samping */
            margin: 0 !important;
        }

        /* Jika pop-up atau kontrol Leaflet tampil aneh, tambahkan CSS di sini */
        .leaflet-popup-content-wrapper {
            /* Contoh: Mengatur lebar maksimum untuk pop-up jika terlalu lebar */
            max-width: 300px;
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', function() {
            // Pastikan peta hanya diinisialisasi sekali dan div 'map' ada
            if (document.getElementById('map') && !document.getElementById('map')._leaflet_id) {
                let map = L.map('map').setView([-7.3756, 111.9169], 13); // Koordinat Tuban

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                const placesData = @json($places);
                console.log("Markers data:", placesData);

                const markerGroup = L.featureGroup().addTo(map);

                if (placesData && placesData.length > 0) {
                    placesData.forEach(place => {
                        const lat = parseFloat(place.latitude);
                        const lng = parseFloat(place.longitude);

                        if (isNaN(lat) || isNaN(lng)) {
                            console.warn(`Skipping marker for place ID ${place.id} due to invalid coordinates: Lat=${place.latitude}, Lng=${place.longitude}`);
                            return;
                        }

                        let popupContent = '';

                        if (place.name) {
                            popupContent += `<b>Nama Tempat:</b> ${place.name}<br>`;
                        }
                        if (place.user && place.user.name) {
                            popupContent += `<b>Dibuat oleh:</b> ${place.user.name}<br>`;
                        }
                        if (place.updated_at) {
                            const updatedAtDate = new Date(place.updated_at);
                            popupContent += `<b>Diperbarui pada:</b> ${updatedAtDate.toLocaleString()}<br>`;
                        }
                        if (place.description) {
                            popupContent += `<b>Deskripsi:</b> ${place.description}<br>`;
                        }
                        if (place.category && place.category.name) {
                            popupContent += `<b>Kategori:</b> ${place.category.name}<br>`;
                        }

                        if (place.latitude && place.longitude) {
                            popupContent += `<b>Koordinat:</b> ${place.latitude}, ${place.longitude}<br>`;
                        }

                        if (place.panjang) {
                            popupContent += `<b>Panjang:</b> ${place.panjang} meter<br>`;
                        }
                        if (place.lebar) {
                            popupContent += `<b>Lebar:</b> ${place.lebar} meter<br>`;
                        }
                        if (place.tipe && Array.isArray(place.tipe) && place.tipe.length > 0) {
                            popupContent += `<b>Jenis Permukaan:</b> ${place.tipe.join(', ')}<br>`;
                        }

                        if (place.attachment && Array.isArray(place.attachment) && place.attachment.length > 0) {
                            popupContent += `<br><strong>Lampiran Gambar (${place.attachment.length} foto):</strong><br>`;

                            const firstImageUrl = `/storage/${place.attachment[0]}`;
                            popupContent += `
                                <a href="${firstImageUrl}" target="_blank" style="display: block; text-align: center; margin-bottom: 5px;">
                                    <img src="${firstImageUrl}" alt="Gambar Utama" style="max-width: 150px; height: auto; border-radius: 5px;">
                                </a>
                            `;

                            if (place.attachment.length > 1) {
                                popupContent += `<strong>Gambar Lainnya:</strong><br>`;
                                place.attachment.forEach((imagePath, index) => {
                                    if (index > 0) { // Lewati gambar pertama karena sudah ditampilkan
                                        const otherImageUrl = `/storage/${imagePath}`;
                                        popupContent += `
                                            <a href="${otherImageUrl}" target="_blank" style="display: inline-block; margin-right: 5px; margin-bottom: 5px;">
                                                <img src="${otherImageUrl}" alt="Gambar ${index + 1}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 3px;">
                                            </a>
                                        `;
                                    }
                                });
                            }
                        } else {
                            popupContent += `<br>Lampiran Gambar: Tidak Ada`;
                        }

                        const newMarker = L.marker([lat, lng])
                            .bindPopup(popupContent);

                        markerGroup.addLayer(newMarker);
                    });

                    map.fitBounds(markerGroup.getBounds());
                } else {
                    console.info("No places data available to display markers.");
                }

                // Ini penting untuk memastikan peta merender dengan benar di dalam container yang disembunyikan awalnya
                // atau jika ukuran container berubah.
                setTimeout(() => {
                    map.invalidateSize();
                }, 100); // Penundaan kecil untuk memastikan rendering yang benar
            }
        });
    </script>
</div>
