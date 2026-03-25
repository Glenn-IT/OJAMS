<!-- ============================================
     Modal: Edit Job (Admin)
     ============================================ -->
<div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editJobModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Job Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="editJobForm">
                    <div class="mb-3">
                        <label class="form-label">Job Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editJobTitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editJobCompany" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" id="editJobDescription" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Qualifications <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editJobQualification" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Posted</label>
                            <input type="date" class="form-control" id="editJobDate">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="editJobStatus">
                                <option value="Open">Open</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-warning" onclick="saveJobEdit()">
                    <i class="bi bi-save me-1"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
