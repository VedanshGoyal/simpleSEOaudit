$(function() {
	var pattern = /(http:|https:)/i;		
	$("#view-source").click(function() {
		if($("#meta-check").val() == ""){
			alert("Input must not be empty.");
			return false;
		}else{
			meta = $("#meta-check").val();
			var i = 0, a = 0, urlLength = meta.length;
			while (i <= urlLength) {
				if((meta.charCodeAt(i)==10)||(i == urlLength-1))
				{
					temp = "view-source:"+meta.substring(a,i+1)
					
					if(a+1!=i){
						if(!temp.match(pattern)){
							temp = "view-source:http://"+temp.split(' ').join('');
						}
						window.open(temp);
					}
					a = i;
				}
				i++
			}
		}
	});
			
	$("#open-links-url").click(function() {
		if($("#url-check").val() == ""){
			alert("Input must not be empty.");
			return false;
		}else{
			url = $("#url-check").val();
			var i = 0, a = 0, urlLength = url.length;
			while (i <= urlLength) {
				if((url.charCodeAt(i)==10)||(i == urlLength-1))
				{
					temp = url.substring(a,i+1)
					if(a+1!=i){
						if(!temp.match(pattern)){
							temp = "http://"+temp.split(' ').join('');
						}
						window.open(temp);
					}
					a = i;
				}
				i++
			}
		}
	});
	
	$("#open-links-meta").click(function() {
		if($("#meta-check").val() == ""){
			alert("Input must not be empty.");
			return false;
		}else{
			url = $("#meta-check").val();
			var i = 0, a = 0, urlLength = url.length;
			while (i <= urlLength) {
				if((url.charCodeAt(i)==10)||(i == urlLength-1))
				{
					temp = url.substring(a,i+1)
					if(a+1!=i){
						if(!temp.match(pattern)){
							temp = "http://"+temp.split(' ').join('');
						}
						window.open(temp);
					}
					a = i;
				}
				i++
			}
		}
	});		
	
	$("#url-check").change(function() {
		url = $("#url-check").val();		
		
		var i = 0, a = 0, urlLength = url.length;
		var textVal = "";
		while (i <= urlLength) {
			if((url.charCodeAt(i)==10)||(i == urlLength-1))
			{
				url_list = url.substring(a,i+1);
					if(!url_list.match(pattern)){
						url_final = "http://" + url_list;
						url_filter = url_final.replace(/[\r\n]/gm,'');
						textVal += url_filter+"\n";
					}else{
						url_finals = url_list;
						url_filters = url_finals.replace(/[\r\n]/gm,'');
						textVal += url_filters+"\n";
					}
				a = i;
			}
			i++
		}
		$("#url-check").val(textVal);
	});
	
	$("#meta-check").change(function() {
		meta = $("#meta-check").val();		
		
		var i = 0, a = 0, urlLength = meta.length;
		var textVal = "";
		while (i <= urlLength) {
			if((meta.charCodeAt(i)==10)||(i == urlLength-1))
			{
				url_list = meta.substring(a,i+1);
					if(!url_list.match(pattern)){
						url_final = "http://" + url_list;
						url_filter = url_final.replace(/[\r\n]/gm,'');
						textVal += url_filter+"\n";
					}else{
						url_finals = url_list;
						url_filters = url_finals.replace(/[\r\n]/gm,'');
						textVal += url_filters+"\n";
					}
				a = i;
			}
			i++
		}
		$("#meta-check").val(textVal);
	});
	
	// Word Count Code //
	
	var box = $("#box");
    box.keypress(wordCount).blur(wordCount).change(wordCount).keyup(wordCount);
    box.keypress(keywordDensity).blur(keywordDensity).change(keywordDensity).keyup(keywordDensity);

    /* Word and Character count Functions */

    function wordCount() {
        var count = new Array();
        box = $("#box");

        var fullStr = box.val() + " ";
        var initial_whitespace_rExp = /^[^A-Za-z0-9]+/gi;
        var left_trimmedStr = fullStr.replace(initial_whitespace_rExp, "");
        var non_alphanumerics_rExp = rExp = /[^A-Za-z0-9'-]+/gi;
        var cleanedStr = left_trimmedStr.replace(non_alphanumerics_rExp, " ");
        var splitString = cleanedStr.split(" ");

        count['words']      = splitString.length - 1;
        count['chars']      = box.val().length;
        count['sentences']  = box.val().split(/[.?!](?=\s|\n)/).length;
        count['paragraphs'] = box.val().split(/\n[^\n]/).length;
        count['avg_sentence_length'] = Math.ceil(count['words'] / count['sentences']);

        displayCount(count);
        displayTextBoxes(count);
    }

    function displayTextBoxes(count)
    {
        $("#word_count").val(count['words']);
        $("#character_count").val(count['chars']);
        $("#sentence_count").val(count['sentences']);
        $("#paragraph_count").val(count['paragraphs']);
	$("#avg_sentence_length").val(count['avg_sentence_length']);
    }

    function displayCount(count) {
        if (count['words'] == 1) {
            wordOrWords = " &nbsp;word";
        } else {
            wordOrWords = " &nbsp;words";
        }
        if (count['chars'] == 1) {
            charOrChars = " &nbsp;character";
        } else {
            charOrChars = " &nbsp;characters";
        }

        $("#counted").html('<h3><span class="label label-default">' + count['words'] + '</span>' + wordOrWords + "&nbsp;&nbsp;" + '<span class="label label-default">' + count['chars'] + '</span>' + charOrChars + '</h3>');
    }

    /* Keyword Density Functions */

    function getTotalWeights(arr) {
        var total = 0;
        $.each(arr, function() {
            total += this;
        });
        return total;
    }

    function keywordDensity() {
        var max = 15;
        $.wordStats.computeTopWords(max, $('#box'));
        totalWeights = getTotalWeights($.wordStats.topWeights);
        var text = '<table style="text-align:center;" class="table table-striped"><thead><tr><th>Mention</th><th>Keywords</th><th>Percent(%)</th></tr></thead><tbody>';
        var percentage;
		if($.wordStats.topWords.length == 0){
			text += '<tr><td>&nbsp;</td>';
			text += '<td>&nbsp;</td>';
			text += '<td>&nbsp;</td></tr>';
			text += '<tr><td>&nbsp;</td>';
			text += '<td>&nbsp;</td>';
			text += '<td>&nbsp;</td></tr>';
			text += '<tr><td>&nbsp;</td>';
			text += '<td>&nbsp;</td>';
			text += '<td>&nbsp;</td></tr>';
		
		}else{
		
			for (i = 0; i < $.wordStats.topWords.length; i++) {
				if (i == max) {
					break;
				}
				percentage = (100 * ($.wordStats.topWeights[i] / totalWeights)).toFixed(0);
				// text += '<li><span>' + $.wordStats.topWords[i] + '</span> ' + $.wordStats.topWeights[i] + ' (' + percentage + '%)</li>';			
				text += '<tr><td>' + $.wordStats.topWords[i] + '</td>';
				text += '<td>' + $.wordStats.topWeights[i] + '</td>';
				text += '<td>' + percentage + '% </td></tr>';
			}
		
		}
        
		
		
        text += '</tbody></table>';
        $.wordStats.clear();
        $("#keywords-list").html(text);
    }

    box.bind('paste', function(e) {
        var el = $(this);
        setTimeout(function() {
            var text = $(el).val();
            keywordDensity();
        }, 4);
    });

    // $("#box").highlightTextarea({caseSensitive: false});
    // $("body").on('click', 'li span', function() {
        // $("#box").highlightTextarea('setWords', $(this).text());
    // });	
});