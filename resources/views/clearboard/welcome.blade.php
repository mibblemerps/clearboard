<!DOCTYPE html>
<html>
    <head>
        <title>Clearboard</title>
        
        <link href="//fonts.googleapis.com/css?family=Lato:100|Open+Sans" rel="stylesheet" type="text/css">
        
        <style type="text/css">
            #wrapper {
                margin: 0 auto;
                margin-top: 76px;
                width: 550px;
                
                text-align: center;
            }

            h1 {
                color: #333333;
                font-family: "lato", "arial", sans-serif;
                font-size: 24px;
            }

            p {
                font-family: "open sans", "arial", sans-serif;
            }
        </style>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                var phase = 0;

                // Hide all existing elements.
                $(".component").hide();

                // Fade in elements in different phases
                window.setInterval(function(){
                    $(".component").each(function(){
                        var elmPhase = $(this).attr("data-phase");
                        if (elmPhase === undefined) { return; }

                        if (elmPhase == phase) {
                            $(this).fadeIn(375);
                        }
                    });

                    // Next transition phase
                    phase++;
                }, 500);
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <img src="{{ asset('clearboard/assets/header-inverted.png') }}" data-phase="1" class="component"><br>
            <h1 data-phase="2" class="component">Hello there</h1><br>
            <p data-phase="3" class="component">Welcome to Clearboard</p>
        </div>
    </body>
</html>