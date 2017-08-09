{extend name="base" /}
{block name="body"}
<div class="layui-body">
  <!--tab标签-->
  <div class="layui-tab layui-tab-brief">
    <ul class="layui-tab-title">
      <li class="layui-this">微信支付配置</li>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <form class="layui-form" action="<?= url('wechat/config/index')?>" method="post">
          <div class="layui-form-item">
            <label class="layui-form-label-min">MCH_ID (商户ID)*</label>
            <div class="layui-input-block-min">
              <input type="text" name="mch_id" value="" placeholder="请输入10位商户MCH_ID（必填）" class="layui-input">
              <p class="help-block">
                注意：商户ID必需与微信接口配置公众号APPID对应，否则无法使用支付功能！
              </p>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label-min">PartnerKey (商户密钥)*</label>
            <div class="layui-input-block-min">
              <input type="text" name="partnerkey" value="" placeholder="请输入32位商户支付密钥（必填）" class="layui-input">
              <p class="help-block">
                微信支付商户密钥需要在商户平台配置，必需填写密钥之后才能正常使用微信支付功能。
              </p>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label-min">Apiclient (双向证书)</label>
            <div class="layui-input-block-min">
              <input type="hidden" name="cert_key_md5" value="" class="layui-input layui-input-inline">
              <input type="file" name="file" class="upload-file-key" lay-title="请上传apiclient_key.pem">
              <input type="hidden" name="cert_cert_md5" value="" class="layui-input layui-input-inline">
              <input type="file" name="file" class="upload-file-cert" lay-title="请上传apiclient_cert.pem">
              <p class="help-block">
                企业打款、企业红包、订单退款等操作需要使用双向证书，可在微信商户平台下载证书！
              </p>
            </div>
          </div>
          <hr>
          <div class="layui-form-item">
            <div class="layui-input-block-min">
              <button class="layui-btn" lay-submit lay-filter="*">保存</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{/block}
{block name="script"}
<script>

  /**
   * 通用单图上传
   */
  layui.upload({
    url: "<?= url('api/upload/cert')?>",
    type: 'file',
    elem: '.upload-file-key',
    success: function (data) {
      if (data.error === 0) {

      } else {
        layer.msg(data.message);
      }
    }
  });
  layui.upload({
    url: "<?= url('api/upload/cert')?>",
    type: 'file',
    elem: '.upload-file-cert',
    success: function (data) {
      if (data.error === 0) {

      } else {
        layer.msg(data.message);
      }
    }
  });
</script>
{/block}