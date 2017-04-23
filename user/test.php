
<script>
$(function () {
	return $.require("ready", function () {
		var a, b, c, d, e, f;
		return a = $$("#area-login"),
		e = $$("#form-login"),
		b = e.find("a.btn-login"),
		f = window.Worker ? ["ease-in", "ease-out"] : ["linear", "linear"],
		d = 0 | $.cookie("ac_login_error") || 0,
		d > 3 ? ($$("#form-login div.area-captcha").removeClass("hidden"), $$("#ipt-captcha-login").attr({
			disabled: !1
		}), c = !0) : c = !1,
		e.setup({
			finish: function () {
				return $$("#ipt-captcha-login").val(""),
				$$("#ipt-pwd-login").on("keydown", function (a) {
					return 13 !== a.which && 10 !== a.which || c ? void 0 : $("#form-login a.btn.do").click()
				})
			},
			callback: function () {
				var g, h;
				if (c) {
					if (g = $.trim(e.data().captcha), !g.length) return void $$("#ipt-captcha-login").info({
						text: "warning::请输入验证码。",
						direction: "bottom"
					}).focus()
				} else g = void 0;
				return $.info("info::登录中..."),
				null != (h = system.port.login) && h.abort(),
				system.port.login = $.post("/login.aspx", {
					username: $.trim(e.data().name),
					password: $.trim(e.data().password),
					captcha: g
				}).done(function (e) {
					var g, h;
					return e.success ? ($.info("success::登录成功。"), window.user = {},
					$.save("user"), $.preload(e.img, function () {
						return a.find("div.area-login a.thumb img.avatar").css({
							opacity: 0
						}).attr({
							src: e.img
						}).transition({
							opacity: 1
						},
						300)
					}), a.find("p.welcom span.username").text(e.username), g = $("#area-login .r .area-login"), g.transition({
						opacity: 0,
						rotateY: 180
					},
					700, f[0], function () {
						var b, c, d;
						return a.find("div.area-login").addClass("login-success"),
						g.transition({
							opacity: 1,
							rotateY: 360
						},
						700, f[1]),
						c = a.find("p.notice span"),
						b = 3,
						system.timer.login = setInterval(function () {
							return b--,
							c.text(b),
							0 >= b ? clearInterval(system.timer.login) : void 0
						},
						1e3),
						d = system.param.returnUrl || system.hash.returnUrl || "/",
						setTimeout(function () {
							return location.href = $.parseSafe(d)
						},
						2e3)
					})) : (c && $$("#form-login div.area-captcha img.captcha-pic").click(), d++, $.cookie("ac_login_error", d, {
						expires: 1
					}), (d > 3 || -1 !== e.result.search("captcha")) && ($$("#form-login div.area-captcha").removeClass("hidden"), $$("#ipt-captcha-login").attr({
						disabled: !1
					}), c || setTimeout(function () {
						return location.reload()
					},
					1e3), c = !0), -1 !== e.result.search("captcha") ? (3 >= d && (d = 4, $.cookie("ac_login_error", d, {
						expires: 1
					})), $.info(h = "warning::请输入验证码。"), $$("#ipt-captcha-login").info(h)) : ($.info(h = "warning::" + e.result), b.info(h)))
				}).fail(function () {
					var a;
					return $.info(a = "error::通信失败。请稍后重试。"),
					b.info(a)
				})
			}
		})
	})
});	
</script>