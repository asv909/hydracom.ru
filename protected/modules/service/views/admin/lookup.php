<?php $count = count($lookup_form->data); ?>
<table border="1" bordercolor="339900">
<?php for ($i =0; $i < $count; $i++) {
          $row = $lookup_form->data[$i];
          echo '<tr><td>' . $row['id'] . '</td>';
          if (isset($row['name'])) {
              echo '<td>' . $row['name'] . '</td></tr>';
          } else {
              echo '<td>' . $row['unite'] . '</td></tr>';
          }
      }
?>
</table>