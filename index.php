<?php session_start(); ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Website Fingerprint Test</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>

    </head>
    <body>
        <div class="ui two column doubling stackable grid container">
            <div class="center aligned column">
                <h2>HTML5 Canvas Method</h2>
                <canvas id="drawing" width="130" height="90" style="border:1px solid #d3d3d3;"></canvas>
                <div id="imageurl" style="padding:3px; height: 200px; word-break: break-all; word-wrap: break-word; overflow-y: scroll; border:1px solid #d3d3d3;"></div>
                <br />
                <h3 class="ui label">Hash returned: </h3>
                <div class="ui segment inverted header" id="hashresult"></div><br /><br />
            </div>
            <div class="center aligned column">
                <h2>webGL2 Canvas Method</h2>
                <canvas id="my_Canvas" width="130" height="90" style="border:1px solid #d3d3d3;"></canvas>
                <!-- <canvas id="canvas3" width="130" height="90" style="border:1px solid #d3d3d3;"></canvas> -->
<!--                 <canvas id="glCanvas" width="130" height="90" style="border:1px solid #d3d3d3;"></canvas> -->
                <div id="imageurl2" style="padding:3px; height: 200px; word-break: break-all; word-wrap: break-word; overflow-y: scroll; border:1px solid #d3d3d3;""></div>
                <br />
                <h3 class="ui label">Hash returned: </h3>
                <div class="ui segment inverted header" id="hashresult2"></div>
            </div>
        </div>
        <div class="ui container">
            <h3 class="ui label">Hashes combined: </h3>
            <div class="ui segment center aligned red inverted header" id="hashes"></div>
        </div><br />
        <div class="ui container">
        <h3 class="ui label">User Agent Info: </h3>
            <?php
            function getUserIP()
            {
                $client = @$_SERVER['HTTP_CLIENT_IP'];
                $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                return filter_var($client, FILTER_VALIDATE_IP) ? $client : filter_var($forward, FILTER_VALIDATE_IP) ? $forward : $_SERVER['REMOTE_ADDR'];
            }

            $useragent = $_SERVER['HTTP_USER_AGENT'];

            $browserinfo = get_browser($useragent, true);

            $thisIP = getUserIP();

            // echo '<pre>';
            // print_r($browserinfo);
            // echo '</pre>';

            $browsernamever = $browserinfo['browser'] . ' ' . $browserinfo['version'] . '<br>' . $browserinfo['browser_bits'] . 'bit';
            $browserdevicenamever = $browserinfo['device_name'] . '<br>' . $browserinfo['platform_bits'] . ' bit';
            $browsercookies = $browserinfo['cookies'] = 1 ? 'true' : 'false';
            $browserjs = $browserinfo['javascript'] = 1 ? 'true' : 'false';
            $browserframes = $browserinfo['frames'] = 1 ? 'true' : 'false';
            $browseriframes = $browserinfo['iframes'] = 1 ? 'true' : 'false';
            $browserrendereng = $browserinfo['renderingengine_name'];

            echo '
            <table class="ui table">
                <thead>
                    <tr>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>Platform</th>
                        <th>Cookies Enabled</th>
                        <th>Javascript Enabled</th>
                        <th>Frames Enabled</th>
                        <th>iFrames Enabled</th>
                        <th>Rendering Engine</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . $thisIP . '</td>
                        <td>' . $browsernamever . '</td>
                        <td>' . $browserdevicenamever . '</td>
                        <td>' . $browsercookies . '</td>
                        <td>' . $browserjs . '</td>
                        <td>' . $browserframes . '</td>
                        <td>' . $browseriframes . '</td>
                        <td>' . $browserrendereng . '</td>
                    </tr>
                </tbody>
            </table>';
            ?>
        </div>
        <div class="ui container">
            <div class="ui styled fluid accordion">
                <div class="title">
                    <i class="dropdown icon"></i>
                    Full USer Agent Dump
                </div>
                <div class="content activeition visible" style="display: none;">
                        <?php
                            echo '<pre>';
                            print_r($browserinfo);
                            echo '</pre>';
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <script>
         /*============= Creating a canvas =================*/
         var canvas4 = document.getElementById('my_Canvas');
         gl = canvas4.getContext('experimental-webgl', {preserveDrawingBuffer: true});

         /*============ Defining and storing the geometry =========*/

         var vertices = [
            -1,-1,-1, 1,-1,-1, 1, 1,-1, -1, 1,-1,
            -1,-1, 1, 1,-1, 1, 1, 1, 1, -1, 1, 1,
            -1,-1,-1, -1, 1,-1, -1, 1, 1, -1,-1, 1,
            1,-1,-1, 1, 1,-1, 1, 1, 1, 1,-1, 1,
            -1,-1,-1, -1,-1, 1, 1,-1, 1, 1,-1,-1,
            -1, 1,-1, -1, 1, 1, 1, 1, 1, 1, 1,-1, 
         ];

         var colors = [
            5,3,7, 5,3,7, 5,3,7, 5,3,7,
            1,1,3, 1,1,3, 1,1,3, 1,1,3,
            0,0,1, 0,0,1, 0,0,1, 0,0,1,
            1,0,0, 1,0,0, 1,0,0, 1,0,0,
            1,1,0, 1,1,0, 1,1,0, 1,1,0,
            0,1,0, 0,1,0, 0,1,0, 0,1,0
         ];

         var indices = [
            0,1,2, 0,2,3, 4,5,6, 4,6,7,
            8,9,10, 8,10,11, 12,13,14, 12,14,15,
            16,17,18, 16,18,19, 20,21,22, 20,22,23 
         ];

         // Create and store data into vertex buffer
         var vertex_buffer = gl.createBuffer ();
         gl.bindBuffer(gl.ARRAY_BUFFER, vertex_buffer);
         gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);

         // Create and store data into color buffer
         var color_buffer = gl.createBuffer ();
         gl.bindBuffer(gl.ARRAY_BUFFER, color_buffer);
         gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);

         // Create and store data into index buffer
         var index_buffer = gl.createBuffer ();
         gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, index_buffer);
         gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, new Uint16Array(indices), gl.STATIC_DRAW);

         /*=================== Shaders =========================*/

         var vertCode = 'attribute vec3 position;'+
            'uniform mat4 Pmatrix;'+
            'uniform mat4 Vmatrix;'+
            'uniform mat4 Mmatrix;'+
            'attribute vec3 color;'+//the color of the point
            'varying vec3 vColor;'+

            'void main(void) { '+//pre-built function
               'gl_Position = Pmatrix*Vmatrix*Mmatrix*vec4(position, 1.);'+
               'vColor = color;'+
            '}';

         var fragCode = 'precision mediump float;'+
            'varying vec3 vColor;'+
            'void main(void) {'+
               'gl_FragColor = vec4(vColor, 1.);'+
            '}';

         var vertShader = gl.createShader(gl.VERTEX_SHADER);
         gl.shaderSource(vertShader, vertCode);
         gl.compileShader(vertShader);

         var fragShader = gl.createShader(gl.FRAGMENT_SHADER);
         gl.shaderSource(fragShader, fragCode);
         gl.compileShader(fragShader);

         var shaderProgram = gl.createProgram();
         gl.attachShader(shaderProgram, vertShader);
         gl.attachShader(shaderProgram, fragShader);
         gl.linkProgram(shaderProgram);

         /* ====== Associating attributes to vertex shader =====*/
         var Pmatrix = gl.getUniformLocation(shaderProgram, "Pmatrix");
         var Vmatrix = gl.getUniformLocation(shaderProgram, "Vmatrix");
         var Mmatrix = gl.getUniformLocation(shaderProgram, "Mmatrix");

         gl.bindBuffer(gl.ARRAY_BUFFER, vertex_buffer);
         var position = gl.getAttribLocation(shaderProgram, "position");
         gl.vertexAttribPointer(position, 3, gl.FLOAT, false,0,0) ;

         // Position
         gl.enableVertexAttribArray(position);
         gl.bindBuffer(gl.ARRAY_BUFFER, color_buffer);
         var color = gl.getAttribLocation(shaderProgram, "color");
         gl.vertexAttribPointer(color, 3, gl.FLOAT, false,0,0) ;

         // Color
         gl.enableVertexAttribArray(color);
         gl.useProgram(shaderProgram);

         /*==================== MATRIX =====================*/

         function get_projection(angle, a, zMin, zMax) {
            var ang = Math.tan((angle*.5)*Math.PI/180);//angle*.5
            return [
               0.5/ang, 0 , 0, 0,
               0, 0.5*a/ang, 0, 0,
               0, 0, -(zMax+zMin)/(zMax-zMin), -1,
               0, 0, (-2*zMax*zMin)/(zMax-zMin), 0 
            ];
         }

         var proj_matrix = get_projection(40, canvas4.width/canvas4.height, 1, 100);

         var mov_matrix = [1,0,0,0, 0,1,0,0, 0,0,1,0, 0,0,0,1];
         var view_matrix = [1,0,0,0, 0,1,0,0, 0,0,1,0, 0,0,0,1];

         // translating z
         view_matrix[14] = view_matrix[14]-6;//zoom

         /*==================== Rotation ====================*/

         function rotateZ(m, angle) {
            var c = Math.cos(angle);
            var s = Math.sin(angle);
            var mv0 = m[0], mv4 = m[4], mv8 = m[8];

            m[0] = c*m[0]-s*m[1];
            m[4] = c*m[4]-s*m[5];
            m[8] = c*m[8]-s*m[9];

            m[1]=c*m[1]+s*mv0;
            m[5]=c*m[5]+s*mv4;
            m[9]=c*m[9]+s*mv8;
         }

         function rotateX(m, angle) {
            var c = Math.cos(angle);
            var s = Math.sin(angle);
            var mv1 = m[1], mv5 = m[5], mv9 = m[9];

            m[1] = m[1]*c-m[2]*s;
            m[5] = m[5]*c-m[6]*s;
            m[9] = m[9]*c-m[10]*s;

            m[2] = m[2]*c+mv1*s;
            m[6] = m[6]*c+mv5*s;
            m[10] = m[10]*c+mv9*s;
         }

         function rotateY(m, angle) {
            var c = Math.cos(angle);
            var s = Math.sin(angle);
            var mv0 = m[0], mv4 = m[4], mv8 = m[8];

            m[0] = c*m[0]+s*m[2];
            m[4] = c*m[4]+s*m[6];
            m[8] = c*m[8]+s*m[10];

            m[2] = c*m[2]-s*mv0;
            m[6] = c*m[6]-s*mv4;
            m[10] = c*m[10]-s*mv8;
         }

         /*================= Drawing ===========================*/
         var time_old = 0;

         var animate = function(time) {

            var dt = time-time_old;
            rotateZ(mov_matrix, dt*0.005);//time
            rotateY(mov_matrix, dt*0.002);
            rotateX(mov_matrix, dt*0.003);
            time_old = time;

            gl.enable(gl.DEPTH_TEST);
            gl.depthFunc(gl.LEQUAL);
            gl.clearColor(0.5, 0.5, 0.5, 0.9);
            gl.clearDepth(1.0);

            gl.viewport(0.0, 0.0, canvas4.width, canvas4.height);
            gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
            gl.uniformMatrix4fv(Pmatrix, false, proj_matrix);
            gl.uniformMatrix4fv(Vmatrix, false, view_matrix);
            gl.uniformMatrix4fv(Mmatrix, false, mov_matrix);
            gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, index_buffer);
            gl.drawElements(gl.TRIANGLES, indices.length, gl.UNSIGNED_SHORT, 0);

            window.requestAnimationFrame(animate);
         }
         animate(0);

         var returnit3 = canvas4.toDataURL('image/png', 1.0);

         document.getElementById("imageurl2").innerHTML = '<a href="' + returnit3 + '">' + returnit3 + '</a>';
            $("#hashresult2").load("grabfp.php?png=" + returnit3);
      </script>
        <!-- <script>
            var canvas3 = document.getElementById('canvas3');
            var gl = canvas3.getContext('experimental-webgl');
            var vertices = [-0.7,-0.1,0,-0.3,0.6,0,-0.3,-0.3,0,0.2,0.6,0,0.3,-0.3,0,0.7,0.6,0];
            var vertex_buffer = gl.createBuffer();

            gl.bindBuffer(gl.ARRAY_BUFFER, vertex_buffer);
            gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);
            gl.bindBuffer(gl.ARRAY_BUFFER, null);

            var vertCode =
            'attribute vec3 coordinates;' + 
            'void main(void) {' + ' gl_Position = vec4(coordinates, 1.0);' + '}';
            var vertShader = gl.createShader(gl.VERTEX_SHADER);

            gl.shaderSource(vertShader, vertCode);
            gl.compileShader(vertShader);

            var fragCode = 'void main(void) {' + 'gl_FragColor = vec4(0.0, 0.0, 0.0, 0.1);' + '}';
            var fragShader = gl.createShader(gl.FRAGMENT_SHADER);

            gl.shaderSource(fragShader, fragCode);
            gl.compileShader(fragShader);
            
            var shaderProgram = gl.createProgram();

            gl.attachShader(shaderProgram, vertShader);
            gl.attachShader(shaderProgram, fragShader);
            gl.linkProgram(shaderProgram);
            gl.useProgram(shaderProgram);
            gl.bindBuffer(gl.ARRAY_BUFFER, vertex_buffer);

            var coord = gl.getAttribLocation(shaderProgram, "coordinates");

            gl.vertexAttribPointer(coord, 2, gl.FLOAT, false, 0, 0);
            gl.enableVertexAttribArray(coord);
            gl.clearColor(0.5, 0.5, 0.5, 0.9);
            gl.enable(gl.DEPTH_TEST);
            gl.clear(gl.COLOR_BUFFER_BIT);
            gl.viewport(0,0,canvas3.width,canvas3.height);
            gl.drawArrays(gl.LINES, 0, 6);

            var imgData3 = gl.getImageData(0, 0, 130, 100);
            var returnit3 = canvas3.toDataURL('image/png', 1.0);
        </script> -->
        <script type="text/javascript">
            var canvas = document.getElementById("drawing");
            var context = canvas.getContext("2d");
            var img = new Image();

            img.src = 'img/fp.png';
            img.onload = function() {
                context.drawImage(img, 60, 25, 65, 85);
            }
            context.font = "italic 18pt Arial";
            context.textBaseline = "top";
            context.fillStyle = 'rgb(200, 0, 0)';
            context.fillText("Pay", 2, 2);
            context.fillStyle = 'rgb(0, 0, 0)';
            context.fillText("Fast", 44, 2);
            context.font = "italic 7pt Arial";
            context.fillText("fingerprinting", 3, 26);
            context.font = "italic 10pt Arial";
            context.fillText("HTML5", 3, 35);
            context.font = "italic 8pt Arial";
            context.fillText("Canvas", 3, 45);
            
            var imgData = context.getImageData(0, 0, 130, 100);
            var returnit = canvas.toDataURL('image/png', 1.0);

            document.getElementById("imageurl").innerHTML = '<a href="' + returnit + '">' + returnit + '</a>';
            $("#hashresult").load("grabfp.php?png=" + returnit);
        </script>
<!--         <script>
            var canvas2 = document.getElementById("glCanvas");
            var ctx = canvas2.getContext("2d");

            var img2 = new Image();

            img2.src = 'img/fp.png';
            img2.onload = function() {
                ctx.drawImage(img2, 60, 25, 65, 85);
            }

            ctx.font = "italic 18pt Arial";
            ctx.textBaseline = "top";
            ctx.fillStyle = 'rgb(200, 0, 0)';
            ctx.fillText("Pay", 2, 2);
            ctx.fillStyle = 'rgb(0, 0, 0)';
            ctx.fillText("Fast", 44, 2);
            ctx.font = "italic 7pt Arial";
            ctx.fillText("fingerprinting", 3, 26);
            ctx.font = "italic 10pt Arial";
            ctx.fillText("webGL2", 3, 35);

            var imgData2 = ctx.getImageData(0, 0, 130, 100);
            var returnit2 = canvas2.toDataURL('image/png', 1.0);

            document.getElementById("imageurl2").innerHTML = '<a href="' + returnit2 + '">' + returnit2 + '</a>';
            $("#hashresult2").load("grabfp.php?png=" + returnit2);
        </script> -->
        <script>
            var hash1 = $("#hashresult")[0].textContent;
            var hash2 = $("#hashresult2")[0].textContent;

            $("#hashes").load("grabhashes.php?hashes=" + hash1 + hash2);
        </script>
        <script>
            $( document ).ready(function() {
                $('.ui.accordion').accordion('toggle' );
            });
        </script>
    </body>
</html>