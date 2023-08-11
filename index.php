<div style="text-align:center;">
  <h2>Subnet Calculator</h2>
  <form method="post" action="">
    <p>
      <label for="ip">IP Address:</label>
      <input type="text" id="ip" name="ip" value="<?php echo isset($_POST['ip']) ? $_POST['ip'] : ''; ?>" />
      <label for="bits">Bits:</label>
      <input type="text" id="bits" name="bits" value="<?php echo isset($_POST['bits']) ? $_POST['bits'] : ''; ?>" />
      <input type="submit" value="Calculate" />
    </p>
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the input values
  $ip = $_POST['ip'];
  $bits = $_POST['bits'];

  // Calculate the subnet mask
  $subnet_mask = long2ip(-1 << (32 - $bits));

  // Calculate the network address
  $network_address = long2ip(ip2long($ip) & ip2long($subnet_mask));

  // Calculate the broadcast address
  $broadcast_address = long2ip(ip2long($network_address) | ~ip2long($subnet_mask));

  // Calculate the number of hosts
  $hosts = pow(2, (32 - $bits)) - 2;

  // Calculate the first usable IP address
  $first_ip = long2ip(ip2long($network_address) + 1);

  // Calculate the last usable IP address
  $last_ip = long2ip(ip2long($broadcast_address) - 1);

  // Calculate the default gateway
  $default_gateway = long2ip(ip2long($network_address) + 1);

  // Output the results in a table
  echo '<div style="text-align:center;">';
  echo '<h2>Subnet Calculation Results</h2>';
  echo '<table style="margin:auto;">';
  echo '<tr><th>IP Address:</th><td>' . $ip . '</td></tr>';
  echo '<tr><th>Bits:</th><td>' . $bits . '</td></tr>';
  echo '<tr><th>Subnet Mask:</th><td>' . $subnet_mask . '</td></tr>';
  echo '<tr><th>Network Address:</th><td>' . $network_address . '</td></tr>';
  echo '<tr><th>Broadcast Address:</th><td>' . $broadcast_address . '</td></tr>';
  echo '<tr><th>Number of Hosts:</th><td>' . $hosts . '</td></tr>';
  echo '<tr><th>First Usable IP:</th><td>' . $first_ip . '</td></tr>';
  echo '<tr><th>Last Usable IP:</th><td>' . $last_ip . '</td></tr>';
  echo '<tr><th>Default Gateway:</th><td>' . $default_gateway . '</td></tr>';
  echo '</table>';
  echo '</div>';
}
?>

