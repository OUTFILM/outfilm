<link href="airpost.css" rel="stylesheet" type="text/css" /> 
<meta charset="UTF-8">


<div id="form_container">
<form class="form-style-7">
<ul>
<li>
    <label for="ch_name">汉译名</label>
    <input type="text" name="ch_name" maxlength="100">
    <span>请填写汉译名</span>
</li>
<li>
    <label for="en_name">英译名</label>
    <input type="text" name="en_name" maxlength="100">
    <span>请填写英译名</span>
</li>
<li>
    <label for="region">国家</label>
    <input type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="region">年份</label>
    <input type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="region">时长</label>
    <input type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="region">类型</label>
    <input type="text" name="region" maxlength="10">
    <span>请填写类型，标签之间用空格</span>
</li>
<li>
    <label for="url">下载链接</label>
    <input type="url" name="url" maxlength="150">
    <span>下载链接 (eg: http://www.google.com) 150字符之内</span>
</li>
<li>
    <label for="url">在线链接</label>
    <input type="url" name="url" maxlength="150">
    <span>在线链接s (eg: http://www.google.com) 150字符之内</span>
</li>
<li>
    <label for="bio">简介</label>
    <textarea name="bio" onkeyup="adjust_textarea(this)"></textarea>
    <span>请填写豆瓣简介或IMDB</span>
</li>
<li>
    <input type="submit" value="Send This" >
</li>
</ul>
</form>
</div>
<script type="text/javascript">
//auto expand textarea
function adjust_textarea(h) {
    h.style.height = "20px";
    h.style.height = (h.scrollHeight)+"px";
}
</script>