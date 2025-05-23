jQuery(document).ready(function($){
    const total = $('p#total_share');
    const members = $('p#total_people');
	total.append(parseInt(ajax_front.total_share).toLocaleString());
    members.append(parseInt(ajax_front.total_people));
});