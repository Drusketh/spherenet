(
    function(){
        var form = document.getElementById("upd");
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
                                console.log(arr[j] + ": " + arr[j+1] + ", " + j + " " + arr.length);
                                arr[j+1] = value;
                                mhtml = arr.join('","');

                                if (arr.length-2 == j) { 
                                    mhtml += '\"]';
                                }
                            }
                        }

                        countp.value = mhtml;

                        form.submit();
                    })
                }
            )
        }
    }
)();

(
    function(){
        var form = document.getElementById("pop");
        var data = form.children[2]

        data.addEventListener("change", function() {
            form.submit();
        })
    }
)();

(
    function(){
        var population = document.getElementById("pop").children[2];
        var goalpop = document.getElementById("goalpop");
        var span1 = document.getElementById("goalpopturns");
        var span2 = document.getElementById("goalpopdays");
        var span3 = document.getElementById("goalpopview");

        function splitTime(hrs){
            var d = Math.floor(hrs/24);
            var remainder = hrs % 24;
            var h = Math.ceil(remainder);

            return(d + " days and " + h + " hours")
        }

        function update() {
            var turns = Math.ceil(Math.log(goalpop.value/population.value)/(1*Math.log(1+0.005/1)));
    
            span1.innerHTML = turns;
            span2.innerHTML = splitTime(turns);
            span3.innerHTML = goalpop.value;
        }

        update();

        goalpop.addEventListener("change", function() {
            update();
        })
    }
)();