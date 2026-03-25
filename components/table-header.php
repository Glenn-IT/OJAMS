<!-- ============================================
     Component: Table Header
     Usage: Pass $columns array of column names
     ============================================ -->
<thead class="table-dark">
    <tr>
        <?php foreach ($columns as $col): ?>
            <th><?php echo $col; ?></th>
        <?php endforeach; ?>
    </tr>
</thead>
