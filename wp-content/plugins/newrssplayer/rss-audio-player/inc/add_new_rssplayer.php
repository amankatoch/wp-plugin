<div class="wrap">
<h1 align="left">Add New RSS Feed</h1>
<form action="" method="post">
	<table  class="form-table">
		<tr>
			<th scope="row" style="">Enter Feed Title</th>
			<td><input type="text" id="new_title" placeholder="Enter Title" name="new_title"></td>
		</tr>
		<tr>
			<th scope="row" style="">Enter RSS Url</th>
			<td><input type="text" id="new_url" placeholder="Paste New Rss URL" name="new_url"></td>
		</tr>
		<tr>
			<th scope="row" style="">Enter No. Of Feed Items To Show</th>
			<td><input type="number" min="1" max="100" placeholder="Enter Any Number" name="rss_num" id="rss_num" style="width: 188px;"></td>
		</tr>
		<tr>
			<th scope="row" style="">Hide Description</th>
			<td><input type="checkbox" value="1" id="hide_description" name="hide_description" /></td>
		</tr>
		<tr>
			<td  colspan="2"><input class="button button-primary button-large" type="button" value="Submit" name="add_rss" onclick="show_rss('<?php echo plugin_dir_url( __FILE__ ); ?>','insert')" ></td>
		</tr>
	</table>
</form>
</div>
<div id="rssOutput"></div>