<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buluterol developer</title>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Logo</h1>
        </div>
    </header>

    <nav>
        <!-- Sayfanın gezinme bağlantıları (menü) buraya gelebilir -->
    </nav>

    <main>
        <!-- Sayfanın ana içeriği buraya gelebilir -->
        <section>
            <div id="3d_obj"></div>
            <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>
            <script type="importmap">
                {
				"imports": {
					"three": "/buluterol.dev/build/three.module.js",
					"three/addons/": "/buluterol.dev/jsm/"
				}
			}
		    </script>
            <script type="module">
                import * as THREE from 'three';

                import {
                    OrbitControls
                } from 'three/addons/controls/OrbitControls.js';
                import {
                    GLTFLoader
                } from 'three/addons/loaders/GLTFLoader.js';
                import {
                    RGBELoader
                } from 'three/addons/loaders/RGBELoader.js';

                let camera, scene, renderer;

                init();
                render();

                function init() {

                    const container = document.getElementById("3d_obj");
                    document.body.appendChild(container);

                    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.25, 20);
                    camera.position.set(-1.8, 0.6, 2.7);

                    scene = new THREE.Scene();

                    new RGBELoader()
                        .setPath('textures/equirectangular/')
                        .load('royal_esplanade_1k.hdr', function(texture) {

                            texture.mapping = THREE.EquirectangularReflectionMapping;

                            scene.background = texture;
                            scene.environment = texture;

                            render();

                            // model

                            const loader = new GLTFLoader().setPath('models/gltf/DamagedHelmet/glTF/');
                            loader.load('DamagedHelmet.gltf', function(gltf) {

                                scene.add(gltf.scene);

                                render();

                            });

                        });

                    renderer = new THREE.WebGLRenderer({
                        antialias: true
                    });
                    renderer.setPixelRatio(window.devicePixelRatio);
                    renderer.setSize(window.innerWidth, window.innerHeight);
                    renderer.toneMapping = THREE.ACESFilmicToneMapping;
                    renderer.toneMappingExposure = 1;
                    renderer.useLegacyLights = false;
                    container.appendChild(renderer.domElement);

                    const controls = new OrbitControls(camera, renderer.domElement);
                    controls.addEventListener('change', render); // use if there is no animation loop
                    controls.minDistance = 2;
                    controls.maxDistance = 10;
                    controls.target.set(0, 0, -0.2);
                    controls.update();

                    window.addEventListener('resize', onWindowResize);

                }

                function onWindowResize() {

                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();

                    renderer.setSize(window.innerWidth, window.innerHeight);

                    render();

                }

                //

                function render() {

                    renderer.render(scene, camera);

                }
            </script>

        </section>

        <section>

        </section>


    </main>

    <aside>
    </aside>

    <footer>
    </footer>
</body>

</html>