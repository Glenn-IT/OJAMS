<!-- ============================================
     Component: Application Row (Admin Table)
     Usage: Pass $app array to render a table row
     ============================================ -->
<tr>
    <td><?php echo $app['name']; ?></td>
    <td><?php echo $app['job_title']; ?></td>
    <td><?php echo $app['date_applied']; ?></td>
    <td>
        <?php
        // Status badge color based on status
        $badgeClass = match($app['status']) {
            'Approved' => 'bg-success',
            'Rejected' => 'bg-danger',
            'Pending'  => 'bg-warning text-dark',
            default    => 'bg-secondary'
        };
        ?>
        <span class="badge <?php echo $badgeClass; ?>"><?php echo $app['status']; ?></span>
    </td>
    <td>
        <!-- Approve Button -->
        <button class="btn btn-sm btn-outline-success me-1" onclick="approveApplication('<?php echo $app['name']; ?>')">
            <i class="bi bi-check-circle"></i> Approve
        </button>
        <!-- Reject Button -->
        <button class="btn btn-sm btn-outline-danger me-1" onclick="rejectApplication('<?php echo $app['name']; ?>')">
            <i class="bi bi-x-circle"></i> Reject
        </button>
        <!-- View Details Button -->
        <button class="btn btn-sm btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#viewApplicationModal"
                onclick="viewApplicationDetails('<?php echo $app['name']; ?>', '<?php echo $app['job_title']; ?>', '<?php echo $app['date_applied']; ?>', '<?php echo $app['status']; ?>')">
            <i class="bi bi-eye"></i> View
        </button>
    </td>
</tr>
