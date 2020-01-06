<?
include 'layout/layout.php';
$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?//$layout->CssJsFile("<script>alert('ts');</script>");?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content">
	  <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 mt" style="min-height:1000px;"> 
            <!--CONTENT -->
<pre>
1. PIO Collector
</pre>
			<!--CONTENT END-->
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <?//$layout->JsFile("<script>alert('ts');</script>");?>
  <?$layout->js($js);?>
</body>

</html>
