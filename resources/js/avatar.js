import * as THREE from 'three';

// Placeholder avatar: un icosahedre qui tourne doucement. A remplacer par le vrai
// modele/rig d'avatar une fois la direction artistique du personnage tranchee.
// Respecte prefers-reduced-motion : pas de rotation si l'utilisateur l'a demande.
function mountAvatar() {
    const canvas = document.getElementById('avatar-canvas');
    if (!canvas || canvas.dataset.mounted) return;
    canvas.dataset.mounted = 'true';

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
    renderer.setSize(48, 48, false);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(35, 1, 0.1, 10);
    camera.position.set(0, 0, 3);

    const geometry = new THREE.IcosahedronGeometry(1, 0);
    const material = new THREE.MeshStandardMaterial({ color: 0x3d6b5c, flatShading: true });
    const mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);

    scene.add(new THREE.AmbientLight(0xffffff, 0.6));
    const light = new THREE.DirectionalLight(0xffffff, 0.8);
    light.position.set(2, 2, 2);
    scene.add(light);

    function render() {
        if (!reduceMotion) {
            mesh.rotation.y += 0.01;
            mesh.rotation.x += 0.005;
        }
        renderer.render(scene, camera);
        requestAnimationFrame(render);
    }
    render();
}

document.addEventListener('DOMContentLoaded', mountAvatar);
document.addEventListener('livewire:navigated', mountAvatar);
