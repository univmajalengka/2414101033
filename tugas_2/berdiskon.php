
<?php

function hitungDiskon($totalBelanja) {
    
    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;
    } 
    elseif ($totalBelanja >= 50000 && $totalBelanja < 100000) {
        $diskon = 0.05 * $totalBelanja;
    } 
    else {
        $diskon = 0;
    }
 
    return $diskon;
}

$totalBelanja = 120000;

$diskon = hitungDiskon($totalBelanja);

$totalBayar = $totalBelanja - $diskon;

echo "=== STRUK BELANJA ===\n"; 
echo "Total Belanja : Rp " . number_format($totalBelanja, 0, ',', '.') . "\n";
echo "Potongan Diskon : Rp " . number_format($diskon, 0, ',', '.') . "\n";
echo "-----------------------------\n";
echo "Total Bayar   : Rp " . number_format($totalBayar, 0, ',', '.') . "\n";

?>
