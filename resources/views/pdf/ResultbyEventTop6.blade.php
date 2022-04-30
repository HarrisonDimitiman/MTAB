
<!DOCTYPE html>
<html>
<style>
    @page  
    { 
        size: 21cm 29.7cm;
        margin: 5px;
        font-family: Arial, sans-serif;
    }
    body  
    { 

      background:  no-repeat fixed center; 
      background-repeat: no-repeat;
      background-attachment: fixed;
      margin:2.5mm 2.5mm 2.5mm 2.5mm;
    }
}
    
</style>
<body>
<!-- <div style="border-left:0.8px solid black;height:39px;margin-left:-3px;position:absolute;left:450px;top:299px;"></div> -->
<!-- <hr style="position:absolute;left:0px;top:330px;width:760px;border-width:0.5;"> -->
<img width="80" height="80" src="{{ public_path('assets/img/mc.png')}}" style="position:absolute;left:40px;top:5px;" alt="">
<img width="80" height="80" src="{{ public_path('assets/img/sk.png')}}" style="position:absolute;left:650px;top:5px;" alt=""> 
<p style="position:absolute;left:270px;top:0px;color: #0073e6;font-size:12px;"><strong>Barangay Maria Cristina, Iligan City</strong><p>
<div style="position:absolute;left:240px;top:15px;"><p style="color: #0073e6;font-size:12px;">Sangguniang Kabataan, Maria Cristina, Iligan City</div>
    <p style="position:absolute;left:245px;top:35px;font-size:12px;">BINIBINING MARIA CRISTINA PAGEANT 2022</p>
<!-- <p style="position:absolute;left:255px;top:50px;font-size:12px;">REGIONAL TRAINING CENTER - ILIGAN</p> -->
<p style="position:absolute;left:310px;top:67px;font-size:10px;">Maria Cristina, Iligan City</p>
<p style="position:absolute;left:314px;top:80px;font-size:10px;">Tel No. (063) 221-5777</p>
<p style="position:absolute;left:220px;top:95px;font-size:15px;">RESULT EVENT BB. MARIA CRISTINA TOP 6</p>


<div style="position:absolute;left:20px;top:150px;">
    <table style="width:100%;border-collapse: collapse;">
    
        <tr>
            <th style="text-align:left;border: 1px solid black;border: 1px solid black;text-align:center;">CON. #</th>
            <th style="text-align:left;border: 1px solid black;border: 1px solid black;text-align:center;">FULL NAME</th>
            <th style="text-align:left;border: 1px solid black;text-align:center;">LOCATION</th>
            <th style="border: 1px solid black;width:10px;">PERCENTAGE</th>
            <th style="border: 1px solid black;width:10px;">RANK</th>
        </tr>
        @foreach($top6 as $i=> $topss)
        <tr>
        <td style="font-size:12px;border: 1px solid black;border: 1px solid black;border: 1px solid black;text-align:center;height:25px;">{{strtoupper($topss->number)}}</td>
            <td style="font-size:12px;border: 1px solid black;border: 1px solid black;border: 1px solid black;border: 1px solid black;text-align:center;height:25px;">{{strtoupper($topss->name)}}</td>
            <td style="font-size:12px;border: 1px solid black;border: 1px solid black;border: 1px solid black;text-align:center;height:25px;">{{strtoupper($topss->location)}}</td>
            <td style="font-size:12px;border: 1px solid black;border: 1px solid black;text-align:center;height:25px;">{{strtoupper($topss->overAllTotalJudge)}}%</td>
            <td style="font-size:12px;border: 1px solid black;text-align:center;">{{ $loop->iteration }}</td>
        </tr>
        @endforeach
    </table>
    <br><br><br><br><br>
    <table style="width:720px;border-collapse: collapse;">
        <tr>
            <th style="text-align:left;border: 1px solid black;border: 1px solid black;text-align:center;"text-align:center;>JUDGE'S NAME</th>
            <th style="text-align:left;border: 1px solid black;border: 1px solid black;text-align:center;"text-align:center;>SIGNATURE</th>
        </tr>
        @foreach($getUserJudge as $i=> $getUserJudges)
        <tr>
        <td style="font-size:12px;border: 1px solid black;border: 1px solid black;border: 1px solid black;text-align:center;height:30px;">{{strtoupper($getUserJudges->name)}}</td>
            <td style="font-size:12px;border: 1px solid black;border: 1px solid black;border: 1px solid black;border: 1px solid black;text-align:center;height:30px;"></td>
           
        </tr>
        @endforeach
    </table>
</div>

<img width="200" height="80" src="{{ public_path('assets/img/bb.jpg')}}" style="position:absolute;left:550px;top:1020px;" alt="">
<script>
    var dt = new Date();
    document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
</script>

</body>
</html>