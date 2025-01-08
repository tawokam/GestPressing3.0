<?php
require('connect.php');
$se="SELECT *, date_format(date_depot, '%M') as mois, sum(monttotal) as montm FROM facture group by date_format(date_depot, '%M')";
   if($sel=$connec->query($se)){
       while($sele=$sel->fetch()){

           ?>
           <script type="text/javascript">
                      var caissemois = document.getElementById("caissems");
                      var myChart = new Chart(caissems, 
                                { type: 'bar', 
                                data: { labels: ["janv", "fevr", "mars", "avril", "mai", "juin", "juil", "aout", "sept", "oct", "nov", "dec"], 
                                       datasets: [{ label: 'Désactivé le graphe', data: [12, 19, 3, 5, 2, 10 , 3, 17, 5, 10, 10, 10], backgroundColor: [ 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)' ], borderColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ], borderWidth: 1 }] }, 
                                                options: {responsive: false, scales: 
                                                        { yAxes: [
                                                            
                                                             { ticks: 
                                                                 { beginAtZero:true } 
                                                             }] 
                                                         } 
                                                         } 
                                                         }); 
            </script>
            
           <?php
       }
   }
?>