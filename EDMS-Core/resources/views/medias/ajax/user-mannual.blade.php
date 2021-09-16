
<div oncontextmenu="return false">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-sm-12">
                <div class="sv-video">
<div oncontextmenu="return false">

<!-- <div style="background: green; height: 55px; width: 100%; position: fixed; top: 0px; left: 0px; z-index: 101"></div> -->
 <object class="pdfviewer" type="application/pdf" style=" position: fixed; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%; z-index: 100"></object>
</div>
</div>


                    <!-- END similar videos -->
            </div>

        </div>
    </div>
</div>


</div>





<script type="text/javascript">
var url="{{route('streamUser_Mannual', $lang)}}";
var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
xhr.responseType = 'arraybuffer';
xhr.onload = function(e) {
   if (true/*this.status == 200*/) {
        var blob=new Blob([this.response], {type:"application/pdf"});
        var pdfurl = window.URL.createObjectURL(blob)+"#view=FitW";
        $(".pdfviewer").attr("data",pdfurl+'#toolbar=0&navpanes=0&scrollbar=0');
   }
};
xhr.send();
</script>