<?php
/**
 * @var \App\View\AppView $this
 */
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
        .idae-screen {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5vmin;
        }
        .idae-text {
            display: block;
            width: 100%;
            max-width: 100%;
            text-align: center;
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: 0.02em;
            white-space: nowrap;
            font-size: min(28vw, 42vh);
            text-shadow: 0 0.03em 0.15em rgba(0, 0, 0, 0.5);
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
        }
        .idae-back:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="idae-screen" aria-live="polite">
        <p class="idae-text">暇人かよ</p>
    </div>
    <?= $this->Html->link('ログインに戻る', '/', ['class' => 'idae-back']) ?>
</body>
</html>
