<!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?= $row['appointment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
        <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">

            <select name="status" class="form-control">
                <option value="" disabled selected>Status</option>
                <option value="2">Approved</option>
                <option value="3">Rejected</option>
            </select>

                <input type="hidden" name="student_id" value="<?= $row['student_id']?>">
                <input type="hidden" name="counselor_id" value="<?= $row['access_type_id'] ?>">
                <input type="hidden" name="preferred_date" value="<?= $row['appointment_date'] ?>">            
                <input type="hidden" name="preferred_time" value="<?= $row['appointment_time'] ?>">            
                <input type="hidden" name="concern_description" value="<?= $row['reason'] ?>">            
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="verify" class="btn btn-primary" value="Save changes">
      </div>
       </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="approve<?= $row['request_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-header bg-primary text-white">
            <h4>Conducted Counseling Session</h4>
        </div>

        <div class="card-body">

            <form method="POST">

                <input type="hidden" name="request_id" value="<?= $row['request_id']?>">
                <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
                <input type="hidden" name="counselor_id" value="<?= $row['counselor_id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Session Date</label>
                    <input type="date" name="session_date" value="<?= $row['preferred_date']?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Session Time</label>
                    <input type="time" name="session_time" value="<?= $row['preferred_time']?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Session Notes</label>
                    <textarea name="session_notes" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Recommendations</label>
                    <textarea name="recommendations" class="form-control" rows="4" required></textarea>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="save_session" class="btn btn-primary" value="Save Session Notes">
            </form>

        </div>
    </div>
  </div>
</div>

<script>$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})</script>