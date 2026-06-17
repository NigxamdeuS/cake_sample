/**
 * particles.js + stats.js（デバッグ用・任意）
 * 次を body 末尾の順で読み込んでください:
 *   particles.min.js → stats.min.js → particles-init.js → particles-init-with-stats.js
 * また HTML に以下を追加:
 *   <div class="count-particles is-visible">...</div>
 */
(function () {
	if (typeof Stats !== "function") {
		return;
	}

	var stats = new Stats();
	stats.setMode(0);
	stats.domElement.style.position = "fixed";
	stats.domElement.style.left = "0px";
	stats.domElement.style.top = "0px";
	stats.domElement.style.zIndex = "2";
	document.body.appendChild(stats.domElement);

	var countParticles = document.querySelector(".js-count-particles");
	if (!countParticles) {
		return;
	}

	function update() {
		stats.begin();
		stats.end();
		if (
			window.pJSDom &&
			window.pJSDom[0] &&
			window.pJSDom[0].pJS.particles &&
			window.pJSDom[0].pJS.particles.array
		) {
			countParticles.innerText = window.pJSDom[0].pJS.particles.array.length;
		}
		requestAnimationFrame(update);
	}

	requestAnimationFrame(update);
})();
