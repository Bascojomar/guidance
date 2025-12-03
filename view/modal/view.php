<!-- PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <?php

$month = $_GET['month'] ?? date('m');
$year = $_GET['year'] ?? date('Y');
$view = isset($_GET['view']) ? true : false;

use Dompdf\Dompdf;

$sql = "SELECT 
            u.full_name AS student_name, 
            sess.session_date, 
            sess.session_notes, 
            sess.recommendation, 
            sess.outcome
        FROM sessions sess
        JOIN students s ON sess.student_id = s.student_id
        JOIN users u ON s.user_id = u.user_id
        WHERE MONTH(sess.session_date) = '$month' 
        AND YEAR(sess.session_date) = '$year'";

$result = $conn->query($sql);

// Build HTML
$html = "<h2>Counseling Report - $month/$year</h2>";
$html .= "<table border='1' cellpadding='6' cellspacing='0' width='100%'>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Date</th>
                    <th>Notes</th>
                    <th>Recommendation</th>
                    <th>Outcome</th>
                </tr>
            </thead>
            <tbody>";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $html .= "<tr>
                    <td>{$row['student_name']}</td>
                    <td>{$row['session_date']}</td>
                    <td>{$row['session_notes']}</td>
                    <td>{$row['recommendation']}</td>
                    <td>{$row['outcome']}</td>
                  </tr>";
    }
} else {
    $html .= "<tr><td colspan='5'>No records found</td></tr>";
}

$html .= "</tbody></table>";

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Stream PDF
$dompdf->stream(
    "counseling_report_$month-$year.pdf",
    ["Attachment" => !$view] // Attachment=false => view in browser
);
?>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe id="pdfFrame" src="" frameborder="0" width="100%" height="600px"></iframe>
      </div>
    </div>
  </div>
</div>