<!-- ============================================
     Modal: View Application Details (Admin)
     ============================================ -->
<div class="modal fade" id="viewApplicationModal" tabindex="-1" aria-labelledby="viewApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewApplicationModalLabel">
                    <i class="bi bi-eye me-2"></i>Application Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 40%;">Applicant Name</th>
                        <td id="viewAppName">—</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Job Title</th>
                        <td id="viewAppJobTitle">—</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Date Applied</th>
                        <td id="viewAppDate">—</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td id="viewAppStatus">—</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Email</th>
                        <td>sample@email.com</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Contact</th>
                        <td>09171234567</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Skills</th>
                        <td>HTML, CSS, JavaScript, PHP</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Experience</th>
                        <td>Intern at Sample Corp (2024-2025)</td>
                    </tr>
                </table>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>
