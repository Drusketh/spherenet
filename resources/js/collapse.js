(
    function(){
        var triggers=document.querySelectorAll("[data-collapse-target]");
        var collapses=document.querySelectorAll("[data-collapse]");
        if(triggers&&collapses){
            Array.from(triggers).forEach(
                function(trigger){
                    return Array.from(collapses).forEach(
                        function(collapse){
                            if(trigger.dataset.collapseTarget===collapse.dataset.collapse){
                                trigger.addEventListener("click",function(){
                                    if(collapse.style.height&&collapse.style.height!=="0px"){
                                        collapse.style.height=0;
                                        collapse.style.overflow="hidden";
                                        triggr.removeAttribute("open")
                                    }
                                    else{
                                        collapse.style.height="".concat(collapse.children[0].clientHeight*4,"px");
                                        collapse.style.overflow="visible";trigger.setAttribute("open","")
                                    }
                                })
                            }
                        }
                    )
                }
            )
        }
    }
)();

(
    function(){
        var counts = document.querySelectorAll("[data-count]");
        const countp = document.getElementsByName('counts')[0];
        const html = countp.value;
        const arr = html.split('","');
        let mhtml = "";
        let idx = 0;

        if (counts) {
            return Array.from(counts).forEach(
                function(count){
                    count.addEventListener("change", function() {
                        const name = count.getAttribute('data-count');
                        const value = count.value;

                        for (var j = 0; j < arr.length; j++) {
                            if (arr[j].match(name)) {
                                arr[j+1] = value;
                                mhtml = arr.join('","');
                            }
                        }
                        if (name === "Nuclear Reactor") {
                            console.log("Nuking is now Legal");
                            mhtml = mhtml + '\"]';
                        }
                        console.log(mhtml);
                        countp.value = mhtml;
                    })
                }
            )
        }
    }
)();