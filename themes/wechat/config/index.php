{extend name="base" /}
{block name="body"}
<div class="layui-body">
  <!--tab标签-->
  <div class="layui-tab layui-tab-brief">
    <ul class="layui-tab-title">
      <li class="layui-this">微信接口配置</li>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <form class="layui-form" action="<?= url('wechat/config/index')?>" method="post">
          <div class="layui-form-item">
            <label class="layui-form-label">URL (服务器地址)</label>
            <div class="layui-input-block-min">
              <input type="text" name="name" value="" placeholder="URL (服务器地址)" class="layui-input">
              <p class="help-block">
                请复制此URL地址填写在公众号平台 [ 开发 >> 基本配置 ] 中 [ URL ( 服务器地址 ) ]<br>
                注意：URL主域名必需备案，微信服务接口只支持 80 端口 ( http ) 和 443 端口 ( https )
              </p>
            </div>
          </div>
          <hr>
          <div class="layui-form-item">
            <label class="layui-form-label">AppID (应用ID)</label>
            <div class="layui-input-block-min">
              <input type="text" name="name" value="" placeholder="公众号appid(必填)" class="layui-input">
              <p class="help-block">
                公众号应用ID是所有接口必要参数，可以在公众号平台 [ 开发 >> 基本配置 ] 页面获取。
              </p>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">AppSecret (应用密钥)</label>
            <div class="layui-input-block-min">
              <input type="text" name="name" value="" placeholder="AppSecret(必填)" class="layui-input">
              <p class="help-block">
                公众号应用密钥是所有接口必要参数，可以在公众号平台 [ 开发 >> 基本配置 ] 页面授权后获取。
              </p>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Token (令牌)</label>
            <div class="layui-input-block-min">
              <input type="text" name="name" value="" placeholder="Token (必填)" class="layui-input">
              <p class="help-block">
                公众号平台与系统对接认证Token，请优先填写此参数并保存，然后再在微信公众号平台操作对接。
              </p>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Encoding AESKey</label>
            <div class="layui-input-block-min">
              <input type="text" name="name" value="" placeholder="Encoding AESKey" class="layui-input">
              <p class="help-block">
                公众号平台接口设置为加密模式，消息加密密钥必需填写并保持与公众号平台一致。
              </p>
            </div>
          </div>
          <hr>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn">保存</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{/block}