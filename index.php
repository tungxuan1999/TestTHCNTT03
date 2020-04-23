<script>
    function getLinkJSONpt2() {
        var a,b,c;
        a = document.getElementById("inputa").value;
        b = document.getElementById("inputb").value;
        c = document.getElementById("inputc").value;
        window.open("api.php/check/loaiTamGiac?a="+a+"&b="+b+"&c="+c);
    }
    function getLinkJSONyear() {
        var dd,mm,yyyy;
        dd = document.getElementById("inputday").value;
        mm = document.getElementById("inputmonth").value;
        yyyy = document.getElementById("inputyear").value;
        window.open("api.php/check/ngayKeTiep?ngay="+dd+"&thang="+mm+"&nam="+yyyy);
    }
    function getData()
    {
        document.getElementById("txt_apijsonpt2").innerHTML = window.location.host +"/CloudPhpEX/api.php/check/loaiTamGiac?a={BC}&b={CA}&c={AB}";
        document.getElementById("txt_apijsonyear").innerHTML = window.location.host +"/CloudPhpEX/api.php/check/ngayKeTiep?ngay={dd}&thang={mm}&nam={yyyy}";
    }
</script>
<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <title>Ex restful api</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Kiểm tra tam giác</h1>
<a>BC = a, CA = b, AB = c</a>
<form>
    <label for="fname">a</label><br>
    <input type="number" id="inputa" name="fname"><br>
    <label for="lname">b</label><br>
    <input type="number" id="inputb" name="lname"><br>
    <label for="lname">c</label><br>
    <input type="number" id="inputc" name="lname"><br>
    <input type ="button" name="OKE" value="GETJSON" onclick="getLinkJSONpt2()">
</form>
<h3>Api json pt2: </h3><h4 id="txt_apijsonpt2"></h4>
<h1>Tính ngày kế tiếp</h1>
<form>
    <label for="lname">Nhập ngày</label><br>
    <input type="number" id="inputday" name="lname"><br>
    <label for="lname">Nhập tháng</label><br>
    <input type="number" id="inputmonth" name="lname"><br>
    <label for="lname">Nhập năm</label><br>
    <input type="number" id="inputyear" name="lname"><br>
    <input type ="button" name="OKE" value="GETJSON" onclick="getLinkJSONyear()">
</form>
<h3>Api json pt2: </h3><h4 id="txt_apijsonyear"></h4>
<script>getData();</script>
</body>
</html>
