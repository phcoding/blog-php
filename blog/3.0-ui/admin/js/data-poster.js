/**
 * Created by ph on 2016/5/29.
 */
//
//var main = function(){
//    $("[data-set]").click(function(e){
//        var map = $(this).attr("data-set").split(";");
//        //console.log(map);
//        for(var i = 0;i<map.length;i++){
//            if(map[i] != ""){
//                var item = map[i].match("(.*)=(.*)");
//                //console.log(item);
//                var key = item[1];
//                var val = item[2];
//                var sele = "[data-get*="+key+"]";
//
//                for(var j = 0; j<$(sele).length;j++){
//                    elem = $(sele)[j].outerHTML;
//                    elem = elem.replace(new RegExp("@"+key,"g"),val);
//                    $(sele)[j].outerHTML = elem;
//                }
//            }
//        }
//    });
//}
//$(window).ready(main);


var main = function(){
    $("[data-set]").click(function(e){
        var map = $(this).attr("data-set").split(";");
        //console.log(map,"按钮传参表");
        //console.log(map);
        for(var i = 0;i<map.length;i++){
            if(map[i] != ""){
                var item = map[i].match("(.*)=(.*)");
                var key = item[1];
                var val = item[2];

                var sele = "[data-get*="+key+"]";

                //分析每个元素
                for(var j = 0; j<$(sele).length;j++){
                    var dom = $($(sele)[j]);
                    var list = dom.attr("data-get").split(";");
                    //分析元素的每个键值对
                    for(var k = 0;k<list.length;k++){
                        var kv = list[k];//获取一个键值文本
                        if(kv != ""){
                            //获取正则匹配，判断键值类型
                            var it = kv.match("(\\[.*\\]=)?(.*"+key+".*)");

                            if(it){
                                if(it[1]){
                                    var k = it[1].match("\\[(.*)\\]=")[1];
                                    //替换键值
                                    var v = it[2].replace(new RegExp("\\$"+key,"g"),val);
                                    if((k === "readonly" || k === "disabled") && v === ""){
                                        dom.removeAttr(k);
                                    }
                                    else if(k === "text"){
                                        dom.text(v);
                                    }
                                    else if(k === "html"){
                                        dom.html(v);
                                    }
                                    else if(k === 'simditor:text'){
                                        $(".simditor-body").html(v);
                                    }
                                    else{
                                        dom.attr(k,v);
                                    }
                                }else{
                                    //替换html文本
                                    eh = dom[0].outerHTML;
                                    eh = eh.replace(new RegExp("@"+key,"g"),val);
                                    $(sele)[j].outerHTML = eh;
                                }
                            }
                        }
                    }
                }
            }
        }
    });
};
$(window).ready(main);
