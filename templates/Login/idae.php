<?php
/**
 * @var \App\View\AppView $this
 */
$tileCount = 1200;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>暇人かよ</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #0c0734;
            color: #fff;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
        }
        .idae-wall {
            position: fixed;
            inset: 0;
            display: flex;
            flex-wrap: wrap;
            align-content: flex-start;
            gap: 0.1em 0.35em;
            padding: 0.2em 0.15em;
            font-weight: 900;
            font-size: clamp(0.55rem, 2.4vw, 1.25rem);
            line-height: 1.05;
            letter-spacing: 0.02em;
            user-select: none;
            pointer-events: none;
        }
        .idae-cell {
            white-space: nowrap;
            opacity: 0.95;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
        }
        .idae-back {
            position: fixed;
            z-index: 10;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem 1rem;
            background: rgba(12, 7, 52, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 4px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            text-decoration: none;
            pointer-events: auto;
        }
        .idae-back:hover { color: #fff; background: rgba(12, 7, 52, 0.95); }
    </style>
</head>
<body>
    <div class="idae-wall" aria-hidden="true">
        <?php for ($i = 0; $i < $tileCount; $i++) : ?>
            <span class="idae-cell">暇人かよ</span>
        <?php endfor; ?>
    </div>
    <?= $this->Html->link('ログインに戻る', '/', ['class' => 'idae-back']) ?>
</body>
</html>
