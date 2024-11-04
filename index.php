<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Firmbee.com - Free Project Management Platform for remote teams">
  <title>Jopan Apps</title>
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <link href="css/css2.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/0e035b9984.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
// Function to calculate density according to ASTM D1250
if (isset($_POST["submit"])) {
  $observedDensity = $_POST['Density'];
  $observedTemperature = $_POST['Temp'];
  $observedPressure = 100; // Observed pressure in kPa
  $APIgravity = 141.45; // API gravity of the petroleum product

  $result = calculateDensityASTM_D1250($observedDensity, $observedTemperature, $observedPressure, $APIgravity);
}

function calculateDensityASTM_D1250($observedDensity, $observedTemperature, $observedPressure, $APIgravity)
{
  // Perform temperature correction
  $correctedDensity = temperatureCorrection($observedDensity, $observedTemperature);

  // Perform pressure correction
  $correctedDensity = pressureCorrection($correctedDensity, $observedPressure);

  // Calculate density at standard conditions using API gravity
  $densityAtStandardConditions = ($APIgravity / (141.5 / $correctedDensity)) + 0.999;

  return $densityAtStandardConditions;
}

// Function to perform temperature correction
function temperatureCorrection($observedDensity, $observedTemperature)
{
  // Implement temperature correction calculation
  // For simplicity, let's assume a linear temperature correction
  // You would typically use ASTM D1250 tables or equations for this calculation
  $temperatureCorrectionFactor = 1 + 0.0008 * ($observedTemperature - 15);
  $correctedDensity = $observedDensity * $temperatureCorrectionFactor;
  return $correctedDensity;
}

// Function to perform pressure correction
function pressureCorrection($observedDensity, $observedPressure)
{
  // Implement pressure correction calculation
  // For simplicity, let's assume a linear pressure correction
  // You would typically use ASTM D1250 tables or equations for this calculation
  $pressureCorrectionFactor = 1 + 0.0004 * ($observedPressure - 101.325);
  $correctedDensity = $observedDensity * $pressureCorrectionFactor;
  return $correctedDensity;
}
?>

<body>
  <main>
    <br>
    <div class="container text-center">
      <h2>Converter ASTM D1250 From table 53B</h2>
      <br>
    </div>
    <div class="container text-center">
      <form method="post" action="">
        <div class="row g-2">
          <div class="col-12">
            <div class="form-floating">
              <input type="number" class="form-control" id="QTY" placeholder="p">
              <label for="floatingInputGrid">Qty Depo (Liter)</label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-floating">
              <input type="number" class="form-control" id="Temp" name="Temp" placeholder="p">
              <label for="floatingInputGrid">Temp Depo (<span>&#8451;</span>) </label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-floating">
              <input type="number" class="form-control" id="Density" name="Density" placeholder="p">
              <label for="floatingInputGrid">Density Depo (g/ml)</label>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit" name="submit" value="Calc">Calculate</button>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-6 offset-3">
            <input type="number" class="form-control" readonly="readonly" name="result" placeholder="Density at 15 &#8451;" value="<?php echo $result; ?>" disable>
          </div>
        </div>
      </form>
    </div>
  </main>
  <div class="fb2022-copy">Fbee 2022 copyright</div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/addshadow.js"></script>
  <!-- <script>
    $("form").submit(function() {
      $.post($(this).attr("action"), $(this).serialize());
      return false;
    });
  </script> -->
</body>

</html>