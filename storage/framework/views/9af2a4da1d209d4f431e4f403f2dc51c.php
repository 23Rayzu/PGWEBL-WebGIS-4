<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            width: 100%;
            height: 400px;
            margin-bottom: 20px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="map"></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Stasiun</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $stations = [
                    ['name' => 'Stasiun Gambir', 'lat' => -6.176533, 'lng' => 106.830622],
                    ['name' => 'Stasiun Pasar Senen', 'lat' => -6.173062, 'lng' => 106.844673],
                    ['name' => 'Stasiun Gondangdia', 'lat' => -6.184720, 'lng' => 106.837437],
                    ['name' => 'Stasiun Kemayoran', 'lat' => -6.159832, 'lng' => 106.843426],
                    ['name' => 'Stasiun Juanda', 'lat' => -6.165868, 'lng' => 106.835691],
                    ['name' => 'Stasiun Tanah Abang', 'lat' => -6.184390, 'lng' => 106.815730],
                    ['name' => 'Stasiun Sawah Besar', 'lat' => -6.159584, 'lng' => 106.831200],
                ];
            ?>

            <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($station['name']); ?></td>
                    <td><?php echo e($station['lat']); ?></td>
                    <td><?php echo e($station['lng']); ?></td>
                    <td>
                        <button class="btn btn-primary" onclick="focusMarker(<?php echo e($station['lat']); ?>, <?php echo e($station['lng']); ?>)">Lihat di Peta</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-6.176533, 106.830622], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = {};

        <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            markers["<?php echo e($station['name']); ?>"] = L.marker([<?php echo e($station['lat']); ?>, <?php echo e($station['lng']); ?>]).addTo(map)
                .bindPopup("<?php echo e($station['name']); ?>");
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        function focusMarker(lat, lng) {
            map.setView([lat, lng], 15);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\example-app\resources\views/table.blade.php ENDPATH**/ ?>