<?php
$kec_url = admin_url('admin-ajax.php');
wp_enqueue_script('ajax_cek_resi', plugins_url('/js/cekresi.js', __FILE__), array('jquery'));
wp_enqueue_script('select2-js', plugins_url() . '/woocommerce/assets/js/select2/select2.js');
wp_enqueue_style('select2', plugins_url() . '/woocommerce/assets/css/select2.css');
wp_localize_script('ajax_cek_resi', 'PT_Ajax_Cek_Resi', array(
  'ajaxurl'       => $kec_url,
  'nextNonce'     => wp_create_nonce('myajax-next-nonce'),
));
get_header();
$_noresi = $_GET["noresi"];
?>

<div class="clearfix"> </div>
<div id="cekresiwrapper">
  <div id="plakatcekresi">
    <div id="form_div">
      <div class="row">
        <div class="col-sm-3" style="margin-top: 10px;">
          <input placeholder="<?php echo  __('Your tracking number', 'epeken-all-kurir'); ?>" type="text" name="noresi" style="border: 1px solid #286090; padding: 3px 10px; width: 100%;" id="noresi" value="<?php echo $_noresi; ?>" />
        </div>
        <div class="col-sm-2" style="margin-top: 10px;">
          <select name="kurir" id="kurir" style="width: 100%; height: 32px; margin: 0;">
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="jnt">J&T</option>
            <option value="wahana">WAHANA</option>
            <option value="pos">POS</option>
            <option value="sicepat">SICEPAT</option>
          </select>
        </div>
        <div class="col-sm-2" style="margin-top: 10px;">
          <button type="submit" class="btn button" id="cekbutton">Cek Resi</button>
        </div>
        <div class="col-sm-12">
          <p style="font-size: 12px;"><small>*) Masukan Nomor Resi, Pilih Jasa Pengiriman kemudian Klik tombol Cek Resi</small></p>
        </div>
      </div>
    </div>
    <div style="margin-top: 20px;">Hasil Tracking</div>
    <div id="cekresiresult" style="width: 100%;">
    </div>
  </div>
</div>
<div class="clearfix"> </div>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#kurir').select2();
    do_cek_resi();
  });
</script>
<?php
global $epeken_tikijne;
if (empty($epeken_tikijne)) {
  $filepath = plugin_dir_path(__FILE__);
  include_once($filepath . '../class/shipping.php');
  $epeken_tikijne = new WC_Shipping_Tikijne;
}
if ($epeken_tikijne->settings['show_footer_in_cek_resi'] == "yes") {
  get_footer();
}
?>