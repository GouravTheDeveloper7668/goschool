<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>GoSchool — Sign In | everthings.in</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* ================================================================
   DESIGN TOKENS
================================================================ */
    :root {
      --gold: #F59E0B;
      --gold-l: #FCD34D;
      --gold-d: #B45309;
      --teal: #0D9488;
      --indigo: #4F46E5;
      --rose: #E11D48;
      --emerald: #059669;
      --tr: 0.3s ease;
    }

    [data-theme="light"] {
      --bg: #F7F3EB;
      --card: #FFFFFF;
      --card2: #FDFAF3;
      --sf: rgba(0, 0, 0, .04);
      --sf2: rgba(0, 0, 0, .07);
      --bd: rgba(180, 120, 0, .15);
      --bd2: rgba(180, 120, 0, .28);
      --tx: #18100A;
      --tx2: rgba(24, 16, 10, .60);
      --tx3: rgba(24, 16, 10, .35);
      --ib: rgba(0, 0, 0, .035);
      --if: rgba(245, 158, 11, .07);
      --sh: 0 24px 64px rgba(180, 120, 0, .14), 0 4px 16px rgba(0, 0, 0, .06);
      --sh2: 0 4px 20px rgba(180, 120, 0, .10);
    }

    [data-theme="dark"] {
      --bg: #0A0804;
      --card: #171210;
      --card2: #1E1915;
      --sf: rgba(255, 255, 255, .04);
      --sf2: rgba(255, 255, 255, .07);
      --bd: rgba(245, 158, 11, .13);
      --bd2: rgba(245, 158, 11, .28);
      --tx: #EDE7DA;
      --tx2: rgba(237, 231, 218, .58);
      --tx3: rgba(237, 231, 218, .32);
      --ib: rgba(255, 255, 255, .05);
      --if: rgba(245, 158, 11, .07);
      --sh: 0 24px 64px rgba(0, 0, 0, .55), 0 4px 16px rgba(0, 0, 0, .3);
      --sh2: 0 4px 20px rgba(0, 0, 0, .4);
    }

    /* ================================================================
   RESET & BASE
================================================================ */
    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box
    }

    html {
      height: 100%
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--tx);
      height: 100%;
      overflow: hidden;
      transition: background var(--tr), color var(--tr);
    }

    @media(pointer:fine) {
      body {
        cursor: none
      }
    }

    ::selection {
      background: var(--gold);
      color: #000
    }

    ::-webkit-scrollbar {
      width: 4px
    }

    ::-webkit-scrollbar-track {
      background: var(--bg)
    }

    ::-webkit-scrollbar-thumb {
      background: var(--gold-d);
      border-radius: 2px
    }

    /* ================================================================
   THREE.JS CANVAS
================================================================ */
    #threeCanvas {
      position: fixed;
      inset: 0;
      z-index: 0;
      pointer-events: none;
      transition: opacity .5s;
    }

    [data-theme="light"] #threeCanvas {
      opacity: .32
    }

    [data-theme="dark"] #threeCanvas {
      opacity: .72
    }

    /* ================================================================
   CURSOR
================================================================ */
    .cdot,
    .cring {
      position: fixed;
      pointer-events: none;
      z-index: 99998;
      border-radius: 50%;
      transform: translate(-50%, -50%);
      will-change: left, top;
      display: none;
    }

    .cdot {
      width: 7px;
      height: 7px;
      background: var(--gold);
      transition: width .15s, height .15s
    }

    .cring {
      width: 30px;
      height: 30px;
      border: 1.5px solid var(--gold);
      opacity: .42;
      transition: width .2s, height .2s
    }

    /* ================================================================
   ROOT LAYOUT
================================================================ */
    .root {
      position: relative;
      z-index: 1;
      display: flex;
      height: 100vh;
      width: 100vw;
      overflow: hidden;
    }

    /* ================================================================
   LEFT PANEL
================================================================ */
    .lp {
      flex: 0 0 52%;
      position: relative;
      overflow: hidden;
    }

    @media(max-width:959px) {
      .lp {
        display: none
      }
    }

    .lp-track {
      display: flex;
      height: 100%;
      transition: transform .78s cubic-bezier(.4, 0, .2, 1);
      will-change: transform;
    }

    .lp-slide {
      flex: 0 0 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 0 44px 100px;
    }

    /* Slide backgrounds */
    .s0 {
      background: linear-gradient(155deg, #0A1A0A 0%, #0F280F 45%, #051008 100%)
    }

    .s1 {
      background: linear-gradient(155deg, #08080F 0%, #101030 45%, #040418 100%)
    }

    .s2 {
      background: linear-gradient(155deg, #180A0A 0%, #280F10 45%, #100408 100%)
    }

    .s3 {
      background: linear-gradient(155deg, #080F10 0%, #0F2528 45%, #041215 100%)
    }

    .s4 {
      background: linear-gradient(155deg, #0F0F00 0%, #201A00 45%, #100E00 100%)
    }

    /* Radial glow per slide */
    .lp-slide::before {
      content: '';
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 0
    }

    .s0::before {
      background: radial-gradient(ellipse at 75% 30%, rgba(16, 185, 129, .13), transparent 65%)
    }

    .s1::before {
      background: radial-gradient(ellipse at 75% 30%, rgba(99, 102, 241, .15), transparent 65%)
    }

    .s2::before {
      background: radial-gradient(ellipse at 75% 30%, rgba(244, 63, 94, .12), transparent 65%)
    }

    .s3::before {
      background: radial-gradient(ellipse at 75% 30%, rgba(20, 184, 166, .13), transparent 65%)
    }

    .s4::before {
      background: radial-gradient(ellipse at 75% 30%, rgba(245, 158, 11, .15), transparent 65%)
    }

    /* Big ghost number */
    .lp-bgnum {
      position: absolute;
      right: -18px;
      top: 50%;
      transform: translateY(-55%);
      font-family: 'Syne', sans-serif;
      font-size: 21rem;
      font-weight: 800;
      color: rgba(255, 255, 255, .024);
      line-height: 1;
      pointer-events: none;
      user-select: none;
      z-index: 0;
    }

    /* Brand top-left */
    .lp-brand {
      position: absolute;
      top: 28px;
      left: 36px;
      z-index: 10;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .lp-bico {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: .9rem;
      box-shadow: 0 6px 18px rgba(245, 158, 11, .42);
      flex-shrink: 0;
    }

    .lp-bname {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.42rem;
      color: #FFF8EE;
      letter-spacing: -.3px
    }

    .lp-bname span {
      color: var(--gold)
    }

    /* Slide content */
    .lp-cnt {
      position: relative;
      z-index: 2
    }

    .lp-tag {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 4px 14px 4px 8px;
      border-radius: 50px;
      font-size: .67rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .td {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      animation: tdp 2s infinite
    }

    @keyframes tdp {

      0%,
      100% {
        opacity: 1;
        transform: scale(1)
      }

      50% {
        opacity: .35;
        transform: scale(.55)
      }
    }

    .lp-ico {
      width: 52px;
      height: 52px;
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.22rem;
      margin-bottom: 20px;
    }

    .lp-title {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: clamp(1.9rem, 3.1vw, 2.75rem);
      line-height: 1.08;
      color: #FFF8EE;
      margin-bottom: 13px;
    }

    .lp-desc {
      font-size: .88rem;
      color: rgba(255, 248, 238, .50);
      line-height: 1.82;
      max-width: 380px;
      margin-bottom: 28px
    }

    .lp-stats {
      display: flex;
      gap: 28px
    }

    .lp-stat .n {
      font-family: 'Syne', sans-serif;
      font-size: 1.38rem;
      font-weight: 700;
      color: #FFF8EE
    }

    .lp-stat .l {
      font-size: .61rem;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: rgba(255, 248, 238, .38);
      margin-top: 1px
    }

    /* Nav */
    .lp-nav {
      position: absolute;
      bottom: 30px;
      left: 44px;
      z-index: 10;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .lp-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: rgba(255, 248, 238, .2);
      cursor: pointer;
      border: none;
      padding: 0;
      transition: .3s;
    }

    .lp-dot.on {
      background: var(--gold);
      width: 24px;
      border-radius: 4px
    }

    .lp-arr {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(255, 248, 238, .07);
      border: 1px solid rgba(255, 248, 238, .13);
      color: rgba(255, 248, 238, .55);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .77rem;
      transition: .25s;
    }

    .lp-arr:hover {
      background: var(--gold);
      color: #000;
      border-color: var(--gold)
    }

    /* Progress */
    .lp-prog {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: rgba(255, 248, 238, .06);
      z-index: 10;
      overflow: hidden
    }

    .lp-pfill {
      height: 100%;
      background: linear-gradient(90deg, var(--gold), var(--gold-l));
      transition: width .12s linear;
      width: 0%
    }

    /* ================================================================
   RIGHT PANEL
================================================================ */
    .rp {
      flex: 1;
      background: var(--card);
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow-y: auto;
      overflow-x: hidden;
      transition: background var(--tr);
    }

    /* Topbar */
    .rp-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 26px 0;
      flex-shrink: 0;
    }

    .mob-brand {
      display: none;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.28rem;
      color: var(--tx);
    }

    .mob-brand .lp-bico {
      width: 32px;
      height: 32px;
      font-size: .78rem
    }

    .mob-brand span {
      color: var(--gold)
    }

    @media(max-width:959px) {
      .mob-brand {
        display: flex
      }
    }

    .th-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--sf2);
      border: 1px solid var(--bd2);
      border-radius: 50px;
      padding: 6px 14px 6px 8px;
      cursor: pointer;
      font-size: .74rem;
      font-weight: 600;
      color: var(--tx2);
      transition: .25s;
      font-family: 'DM Sans', sans-serif;
    }

    .th-btn:hover {
      border-color: var(--gold);
      color: var(--gold)
    }

    .th-iw {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .62rem;
      color: #000;
    }

    /* Form area */
    .rp-body {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 24px 32px;
    }

    @media(max-width:480px) {
      .rp-body {
        padding: 18px 16px
      }
    }

    .fcard {
      width: 100%;
      max-width: 420px
    }

    /* Form head */
    .fhead {
      margin-bottom: 26px
    }

    .flogo {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 6px
    }

    .flogo-ico {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: 1.05rem;
      box-shadow: 0 6px 20px rgba(245, 158, 11, .32);
    }

    .flogo-name {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.58rem;
      color: var(--tx);
      letter-spacing: -.35px
    }

    .flogo-name span {
      color: var(--gold)
    }

    .ftag {
      font-size: .72rem;
      color: var(--tx3);
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 5px
    }

    .ftitle {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.72rem;
      color: var(--tx);
      line-height: 1.12;
      margin-bottom: 5px
    }

    .fsub {
      font-size: .84rem;
      color: var(--tx2)
    }

    /* Role tabs */
    .roles {
      display: flex;
      background: var(--sf);
      border-radius: 11px;
      padding: 4px;
      gap: 3px;
      margin-bottom: 22px;
    }

    .rtab {
      flex: 1;
      border: none;
      background: transparent;
      border-radius: 8px;
      padding: 9px 4px;
      font-size: .71rem;
      font-weight: 700;
      color: var(--tx3);
      cursor: pointer;
      transition: .22s;
      font-family: 'DM Sans', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    .rtab.on {
      background: var(--card);
      color: var(--gold);
      box-shadow: var(--sh2)
    }

    .rtab:hover:not(.on) {
      color: var(--tx2)
    }

    /* Banners */
    .ebanner,
    .ibanner {
      display: none;
      align-items: center;
      gap: 9px;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: .79rem;
      margin-bottom: 14px;
      animation: sldn .3s ease;
    }

    .ebanner.show {
      display: flex;
      background: rgba(225, 29, 72, .09);
      border: 1px solid rgba(225, 29, 72, .22);
      color: #E11D48
    }

    .ibanner.show {
      display: flex;
      background: rgba(13, 148, 136, .09);
      border: 1px solid rgba(13, 148, 136, .22);
      color: var(--teal)
    }

    @keyframes sldn {
      from {
        opacity: 0;
        transform: translateY(-8px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    /* Field */
    .fgrp {
      margin-bottom: 14px
    }

    .flbl {
      display: block;
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
      color: var(--tx2);
      margin-bottom: 7px
    }

    .fwrap {
      position: relative
    }

    .fico {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--tx3);
      font-size: .85rem;
      pointer-events: none;
      transition: color .25s;
      z-index: 1
    }

    .finp {
      width: 100%;
      background: var(--ib);
      border: 1.5px solid var(--bd2);
      border-radius: 10px;
      color: var(--tx);
      padding: 11px 44px 11px 38px;
      font-size: .9rem;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: .25s;
    }

    .finp:focus {
      border-color: var(--gold);
      background: var(--if);
      box-shadow: 0 0 0 3px rgba(245, 158, 11, .12)
    }

    .finp:focus+.fico,
    .finp:focus~.fico {
      color: var(--gold)
    }

    .finp::placeholder {
      color: var(--tx3)
    }

    .finp.ok {
      border-color: #059669 !important
    }

    .finp.bad {
      border-color: #E11D48 !important
    }

    /* Eye button */
    .eyebtn {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--tx3);
      font-size: .88rem;
      padding: 4px;
      transition: color .22s;
      z-index: 2;
    }

    .eyebtn:hover {
      color: var(--gold)
    }

    /* Validation hint */
    .vhint {
      display: none;
      align-items: center;
      gap: 4px;
      font-size: .69rem;
      margin-top: 4px
    }

    .vhint.show {
      display: flex
    }

    .vhint.ok {
      color: #059669
    }

    .vhint.bad {
      color: #E11D48
    }

    /* Forgot */
    .frow {
      display: flex;
      justify-content: flex-end;
      margin: -8px 0 15px
    }

    .flink {
      font-size: .75rem;
      color: var(--gold);
      text-decoration: none;
      font-weight: 600;
      transition: opacity .2s
    }

    .flink:hover {
      opacity: .7
    }

    /* ================================================================
   CAPTCHA
================================================================ */
    .cap-lbl {
      display: block;
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
      color: var(--tx2);
      margin-bottom: 7px
    }

    .cap-row {
      display: flex;
      gap: 10px;
      align-items: stretch;
      margin-bottom: 10px
    }

    .cap-shell {
      flex: 1;
      background: var(--sf2);
      border: 1.5px solid var(--bd2);
      border-radius: 10px;
      overflow: hidden;
      height: 54px;
      cursor: not-allowed;
      user-select: none;
    }

    #captchaImg {
      display: block;
      width: 100%;
      height: 54px
    }

    .cap-btn {
      width: 46px;
      height: 54px;
      flex-shrink: 0;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      border: none;
      border-radius: 10px;
      cursor: pointer;
      color: #000;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .95rem;
      box-shadow: 0 4px 14px rgba(245, 158, 11, .32);
      transition: all .25s;
    }

    .cap-btn:hover {
      box-shadow: 0 8px 22px rgba(245, 158, 11, .48)
    }

    .cap-btn.spin i {
      animation: cspin .4s ease forwards
    }

    @keyframes cspin {
      to {
        transform: rotate(360deg)
      }
    }

    .cap-finp {
      letter-spacing: 5px;
      font-weight: 700;
      font-size: .95rem !important;
      text-transform: uppercase
    }

    /* ================================================================
   SUBMIT
================================================================ */
    .bsubmit {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      color: #000;
      font-weight: 800;
      font-size: .95rem;
      font-family: 'Syne', sans-serif;
      border: none;
      border-radius: 11px;
      cursor: pointer;
      letter-spacing: .3px;
      box-shadow: 0 8px 28px rgba(245, 158, 11, .38);
      transition: all .25s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      margin-bottom: 18px;
    }

    .bsubmit:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 14px 36px rgba(245, 158, 11, .48)
    }

    .bsubmit:disabled {
      opacity: .65;
      cursor: not-allowed;
      transform: none
    }

    /* Divider */
    .orline {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: .7rem;
      color: var(--tx3);
      font-weight: 600;
      margin-bottom: 15px;
    }

    .orline::before,
    .orline::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--bd)
    }

    /* SSO */
    .ssorow {
      display: flex;
      gap: 9px
    }

    .ssobtn {
      flex: 1;
      padding: 10px;
      background: var(--ib);
      border: 1.5px solid var(--bd2);
      border-radius: 9px;
      color: var(--tx2);
      font-size: .79rem;
      font-weight: 600;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      transition: .25s;
    }

    .ssobtn:hover {
      border-color: var(--gold);
      color: var(--gold)
    }

    /* ================================================================
   FOOTER
================================================================ */
    .rp-foot {
      flex-shrink: 0;
      border-top: 1px solid var(--bd);
      padding: 11px 22px;
      background: var(--card2);
      transition: background var(--tr);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 8px;
    }

    .fp-main {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: .72rem;
      color: var(--tx3)
    }

    .fp-main strong {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: .82rem;
      color: var(--gold)
    }

    .pdot {
      display: inline-block;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--gold);
      margin-right: 3px;
      animation: pdota 2.2s ease-in-out infinite;
    }

    @keyframes pdota {

      0%,
      100% {
        opacity: 1;
        transform: scale(1)
      }

      50% {
        opacity: .28;
        transform: scale(.45)
      }
    }

    .flinks {
      display: flex;
      gap: 13px
    }

    .flinks a {
      font-size: .69rem;
      color: var(--tx3);
      text-decoration: none;
      transition: color .2s
    }

    .flinks a:hover {
      color: var(--gold)
    }

    .fcopy {
      font-size: .67rem;
      color: var(--tx3)
    }

    /* ================================================================
   SUCCESS OVERLAY
================================================================ */
    .success {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: rgba(5, 3, 0, .93);
      backdrop-filter: blur(12px);
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 18px;
    }

    .success.show {
      display: flex
    }

    .s-ico {
      width: 82px;
      height: 82px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.1rem;
      color: #000;
      animation: ipop .55s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    @keyframes ipop {
      from {
        transform: scale(0) rotate(-30deg);
        opacity: 0
      }

      to {
        transform: scale(1) rotate(0);
        opacity: 1
      }
    }

    .s-t {
      font-family: 'Syne', sans-serif;
      font-size: 1.62rem;
      font-weight: 800;
      color: #FFF8EE;
      animation: fup .5s ease .3s both
    }

    .s-s {
      font-size: .87rem;
      color: rgba(255, 248, 238, .52);
      animation: fup .5s ease .45s both
    }

    @keyframes fup {
      from {
        opacity: 0;
        transform: translateY(14px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    /* ================================================================
   ENTRY ANIMATIONS
================================================================ */
    .fcard>* {
      animation: eu .5s ease both
    }

    .fhead {
      animation-delay: .06s
    }

    .roles {
      animation-delay: .12s
    }

    .fgrp {
      animation-delay: .16s
    }

    .fgrp+.fgrp {
      animation-delay: .22s
    }

    .frow {
      animation-delay: .26s
    }

    .cap-lbl,
    .cap-row,
    .capfgrp {
      animation-delay: .30s
    }

    .bsubmit {
      animation-delay: .38s
    }

    .orline {
      animation-delay: .42s
    }

    .ssorow {
      animation-delay: .46s
    }

    @keyframes eu {
      from {
        opacity: 0;
        transform: translateY(20px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0)
      }

      20%,
      60% {
        transform: translateX(-6px)
      }

      40%,
      80% {
        transform: translateX(6px)
      }
    }

    /* ================================================================
   MOBILE
================================================================ */
    @media(max-width:959px) {
      body {
        overflow: auto
      }

      .root {
        height: auto;
        min-height: 100vh
      }

      .rp {
        height: auto;
        overflow: visible
      }
    }

    @media(max-width:600px) {
      .rp-body {
        padding: 18px 14px
      }

      .ftitle {
        font-size: 1.42rem
      }

      .ssorow {
        flex-direction: column
      }

      .rp-foot {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 8px
      }

      .flinks {
        justify-content: center
      }
    }

    @media(max-width:380px) {
      .rtab {
        font-size: .62rem;
        padding: 8px 2px;
        gap: 3px
      }

      .rp-top {
        padding: 14px 14px 0
      }
    }
  </style>
</head>

<body>

  <canvas id="threeCanvas"></canvas>
  <div class="cdot" id="cdot"></div>
  <div class="cring" id="cring"></div>

  <!-- SUCCESS -->
  <div class="success" id="sucOvl">
    <div class="s-ico"><i class="fas fa-check"></i></div>
    <div class="s-t">Login Successful!</div>
    <div class="s-s" id="sucSub">Welcome back, Administrator</div>
  </div>

  <div class="root">

    <!-- ════ LEFT ════ -->
    <div class="lp" id="lpanel">
      <a class="lp-brand" href="#">
        <div class="lp-bico"><i class="fas fa-graduation-cap"></i></div>
        <div class="lp-bname">Go<span>School</span></div>
      </a>

      <div class="lp-track" id="lpTrack">

        <div class="lp-slide s0">
          <div class="lp-bgnum">01</div>
          <div class="lp-cnt">
            <div class="lp-tag"
              style="background:rgba(16,185,129,.14);color:#6EE7B7;border:1px solid rgba(16,185,129,.25)">
              <div class="td" style="background:#10B981"></div>Module 01
            </div>
            <div class="lp-ico"
              style="background:rgba(16,185,129,.14);color:#10B981;border:1px solid rgba(16,185,129,.2)"><i
                class="fas fa-users"></i></div>
            <div class="lp-title">Student<br>Management</div>
            <div class="lp-desc">Complete profiles, admission tracking, attendance automation and parent communication —
              all unified.</div>
            <div class="lp-stats">
              <div class="lp-stat">
                <div class="n">1,247</div>
                <div class="l">Students</div>
              </div>
              <div class="lp-stat">
                <div class="n">98%</div>
                <div class="l">Attendance</div>
              </div>
              <div class="lp-stat">
                <div class="n">24/7</div>
                <div class="l">Access</div>
              </div>
            </div>
          </div>
        </div>

        <div class="lp-slide s1">
          <div class="lp-bgnum">02</div>
          <div class="lp-cnt">
            <div class="lp-tag"
              style="background:rgba(99,102,241,.14);color:#A5B4FC;border:1px solid rgba(99,102,241,.25)">
              <div class="td" style="background:#6366F1"></div>Module 02
            </div>
            <div class="lp-ico"
              style="background:rgba(99,102,241,.14);color:#818CF8;border:1px solid rgba(99,102,241,.2)"><i
                class="fas fa-chalkboard-teacher"></i></div>
            <div class="lp-title">Class<br>Management</div>
            <div class="lp-desc">Organize sections, timetables, teacher assignments and academic year calendars with
              zero manual effort.</div>
            <div class="lp-stats">
              <div class="lp-stat">
                <div class="n">42</div>
                <div class="l">Classes</div>
              </div>
              <div class="lp-stat">
                <div class="n">12</div>
                <div class="l">Subjects</div>
              </div>
              <div class="lp-stat">
                <div class="n">Auto</div>
                <div class="l">Timetable</div>
              </div>
            </div>
          </div>
        </div>

        <div class="lp-slide s2">
          <div class="lp-bgnum">03</div>
          <div class="lp-cnt">
            <div class="lp-tag"
              style="background:rgba(244,63,94,.14);color:#FDA4AF;border:1px solid rgba(244,63,94,.25)">
              <div class="td" style="background:#F43F5E"></div>Module 03
            </div>
            <div class="lp-ico"
              style="background:rgba(244,63,94,.14);color:#F43F5E;border:1px solid rgba(244,63,94,.2)"><i
                class="fas fa-id-card"></i></div>
            <div class="lp-title">ID Card<br>Generator</div>
            <div class="lp-desc">Auto-generate branded student ID cards with QR codes, barcodes and photos. Bulk print
              1,200+ cards.</div>
            <div class="lp-stats">
              <div class="lp-stat">
                <div class="n">1.2K</div>
                <div class="l">Cards</div>
              </div>
              <div class="lp-stat">
                <div class="n">5 sec</div>
                <div class="l">Per Card</div>
              </div>
              <div class="lp-stat">
                <div class="n">QR+</div>
                <div class="l">Barcode</div>
              </div>
            </div>
          </div>
        </div>

        <div class="lp-slide s3">
          <div class="lp-bgnum">04</div>
          <div class="lp-cnt">
            <div class="lp-tag"
              style="background:rgba(20,184,166,.14);color:#5EEAD4;border:1px solid rgba(20,184,166,.25)">
              <div class="td" style="background:#14B8A6"></div>Module 04
            </div>
            <div class="lp-ico"
              style="background:rgba(20,184,166,.14);color:#14B8A6;border:1px solid rgba(20,184,166,.2)"><i
                class="fas fa-file-alt"></i></div>
            <div class="lp-title">Marksheet<br>Management</div>
            <div class="lp-desc">Enter marks once — auto-generate marksheets, grade cards and rank lists for all exam
              boards.</div>
            <div class="lp-stats">
              <div class="lp-stat">
                <div class="n">96.2</div>
                <div class="l">Avg Score</div>
              </div>
              <div class="lp-stat">
                <div class="n">A+</div>
                <div class="l">Top Grade</div>
              </div>
              <div class="lp-stat">
                <div class="n">PDF</div>
                <div class="l">Instant</div>
              </div>
            </div>
          </div>
        </div>

        <div class="lp-slide s4">
          <div class="lp-bgnum">05</div>
          <div class="lp-cnt">
            <div class="lp-tag"
              style="background:rgba(245,158,11,.14);color:#FCD34D;border:1px solid rgba(245,158,11,.25)">
              <div class="td" style="background:#F59E0B"></div>Module 05
            </div>
            <div class="lp-ico"
              style="background:rgba(245,158,11,.14);color:#F59E0B;border:1px solid rgba(245,158,11,.2)"><i
                class="fas fa-file-invoice-dollar"></i></div>
            <div class="lp-title">Fee Invoice<br>&amp; Billing</div>
            <div class="lp-desc">GST invoices, academic year fee structures, auto-reminders and live payment gateway
              integration.</div>
            <div class="lp-stats">
              <div class="lp-stat">
                <div class="n">&#8377;2.4Cr</div>
                <div class="l">Collected</div>
              </div>
              <div class="lp-stat">
                <div class="n">98%</div>
                <div class="l">Rate</div>
              </div>
              <div class="lp-stat">
                <div class="n">GST</div>
                <div class="l">Compliant</div>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /lp-track -->

      <div class="lp-nav" id="lpNav">
        <button class="lp-arr" id="lpPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
        <!-- dots injected by JS -->
        <button class="lp-arr" id="lpNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
      </div>
      <div class="lp-prog">
        <div class="lp-pfill" id="lpFill"></div>
      </div>
    </div>

    <!-- ════ RIGHT ════ -->
    <div class="rp">
      <div class="rp-top">
        <a href="#" class="mob-brand">
          <div class="lp-bico"><i class="fas fa-graduation-cap"></i></div>
          Go<span>School</span>
        </a>
        <button class="th-btn" onclick="toggleTheme()" aria-label="Toggle theme">
          <div class="th-iw"><i class="fas fa-moon" id="thIco"></i></div>
          <span id="thTxt">Dark Mode</span>
        </button>
      </div>

      <div class="rp-body">
        <div class="fcard" id="fcard">

          <div class="fhead">
            <div class="flogo">
              <div class="flogo-ico"><i class="fas fa-graduation-cap"></i></div>
              <div class="flogo-name">Go<span>School</span></div>
            </div>
            <div class="ftag"><i class="fas fa-building"></i>School Management System &mdash; everthings.in</div>
            <div class="ftitle">Welcome back</div>
            <div class="fsub">Sign in to your account to continue</div>
          </div>

          <div class="roles" id="roleRow">
            <button class="rtab on" onclick="pickRole(this,'Administrator')"><i
                class="fas fa-shield-alt"></i>Admin</button>
            <button class="rtab" onclick="pickRole(this,'Teacher')"><i
                class="fas fa-chalkboard-teacher"></i>Teacher</button>
            <button class="rtab" onclick="pickRole(this,'Student')"><i class="fas fa-user-graduate"></i>Student</button>
            <button class="rtab" onclick="pickRole(this,'Parent')"><i class="fas fa-users"></i>Parent</button>
          </div>

          <div class="ebanner" id="ebar"><i class="fas fa-exclamation-circle"></i><span id="emsg"></span></div>
          <div class="ibanner" id="ibar"><i class="fas fa-envelope"></i><span id="imsg"></span></div>

          <!-- Username -->
          <div class="fgrp">
            <label class="flbl" for="fu"><i class="fas fa-user" style="margin-right:4px;font-size:.66rem"></i>Username /
              Email</label>
            <div class="fwrap">
              <i class="fas fa-user fico"></i>
              <input class="finp" type="text" id="fu" placeholder="Enter username or email" autocomplete="username"
                oninput="vUser(this)">
            </div>
            <div class="vhint" id="vhu"></div>
          </div>

          <!-- Password -->
          <div class="fgrp">
            <label class="flbl" for="fp"><i class="fas fa-lock"
                style="margin-right:4px;font-size:.66rem"></i>Password</label>
            <div class="fwrap">
              <i class="fas fa-lock fico"></i>
              <input class="finp" type="password" id="fp" placeholder="Enter your password"
                autocomplete="current-password" oninput="vPass(this)">
              <button class="eyebtn" type="button" id="eyeBtn" onclick="toggleEye()"
                aria-label="Toggle password visibility">
                <i class="fas fa-eye" id="eyeIco"></i>
              </button>
            </div>
            <div class="vhint" id="vhp"></div>
          </div>

          <div class="frow">
            <a href="#" class="flink" onclick="forgotPw(event)"><i class="fas fa-question-circle"
                style="margin-right:4px"></i>Forgot password?</a>
          </div>

          <!-- CAPTCHA -->
          <label class="cap-lbl"><i class="fas fa-shield-alt" style="margin-right:4px;font-size:.65rem"></i>Security
            Verification</label>
          <div class="cap-row">
            <div class="cap-shell"><canvas id="captchaImg" width="260" height="54"></canvas></div>
            <button class="cap-btn" id="capBtn" type="button" onclick="refreshCap()" title="Refresh CAPTCHA"
              aria-label="Refresh CAPTCHA">
              <i class="fas fa-sync-alt" id="capIco"></i>
            </button>
          </div>
          <div class="fgrp capfgrp">
            <div class="fwrap">
              <i class="fas fa-keyboard fico"></i>
              <input class="finp cap-finp" type="text" id="fc" placeholder="TYPE CODE ABOVE" maxlength="6"
                autocomplete="off" oninput="vCap(this)">
            </div>
            <div class="vhint" id="vhc"></div>
          </div>

          <button class="bsubmit" id="bsub" onclick="doLogin()">
            <i class="fas fa-sign-in-alt"></i><span id="btxt">Sign In to GoSchool</span>
          </button>

          <div class="orline">or continue with</div>

          <div class="ssorow">
            <button class="ssobtn" onclick="doSSO('Google')"><i class="fab fa-google"
                style="color:#EA4335"></i>Google</button>
            <button class="ssobtn" onclick="doSSO('Microsoft')"><i class="fab fa-microsoft"
                style="color:#00A4EF"></i>Microsoft</button>
            <button class="ssobtn" onclick="doSSO('WhatsApp')"><i class="fab fa-whatsapp"
                style="color:#25D366"></i>WhatsApp</button>
          </div>

        </div>
      </div>

      <!-- FOOTER -->
      <footer class="rp-foot">
        <div class="fp-main">
          <span>Powered by</span>
          <span style="display:flex;align-items:center;gap:4px;margin-left:4px"><span
              class="pdot"></span><strong>everthings.in</strong></span>
          <span style="color:var(--bd);margin:0 5px">|</span>
          <span>GoSchool v3.0</span>
          <span style="color:var(--bd);margin:0 5px">|</span>
          <span style="display:flex;align-items:center;gap:3px"><i class="fas fa-map-marker-alt"
              style="font-size:.58rem;color:var(--gold)"></i>Ranchi, Jharkhand</span>
        </div>
        <div class="flinks">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Use</a>
          <a href="#">Support</a>
          <a href="#">Help Docs</a>
        </div>
        <div class="fcopy">&copy; 2025 everthings.in — All rights reserved</div>
      </footer>
    </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script>
    /* ══════════════════ CURSOR ══════════════════ */
    (function () {
      if (!window.matchMedia('(pointer:fine)').matches) return;
      const d = document.getElementById('cdot'), r = document.getElementById('cring');
      d.style.display = r.style.display = 'block';
      let tx = 0, ty = 0, rx = 0, ry = 0;
      document.addEventListener('mousemove', e => { tx = e.clientX; ty = e.clientY }, { passive: true });
      (function t() { d.style.left = tx + 'px'; d.style.top = ty + 'px'; rx += (tx - rx) * .18; ry += (ty - ry) * .18; r.style.left = rx + 'px'; r.style.top = ry + 'px'; requestAnimationFrame(t) })();
      document.addEventListener('mouseover', e => {
        const i = !!e.target.closest('a,button,input');
        d.style.width = d.style.height = i ? '5px' : '7px';
        r.style.width = r.style.height = i ? '46px' : '30px';
      });
    })();

    /* ══════════════════ THREE.JS ══════════════════ */
    (function () {
      const canvas = document.getElementById('threeCanvas');
      const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
      renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(55, innerWidth / innerHeight, .1, 400);
      camera.position.z = 26;
      function rsz() { renderer.setSize(innerWidth, innerHeight); camera.aspect = innerWidth / innerHeight; camera.updateProjectionMatrix() }
      rsz(); window.addEventListener('resize', rsz, { passive: true });

      /* Particles */
      const N = 1100, geo = new THREE.BufferGeometry();
      const pos = new Float32Array(N * 3), vel = new Float32Array(N * 3), col = new Float32Array(N * 3);
      const pal = [[.961, .620, .043], [.051, .580, .502], [.384, .278, .933], [1, .984, .937], [.035, .588, .412]];
      for (let i = 0; i < N; i++) {
        pos[i * 3] = (Math.random() - .5) * 56; pos[i * 3 + 1] = (Math.random() - .5) * 46; pos[i * 3 + 2] = (Math.random() - .5) * 28;
        vel[i * 3] = (Math.random() - .5) * .009; vel[i * 3 + 1] = (Math.random() - .5) * .007; vel[i * 3 + 2] = (Math.random() - .5) * .005;
        const c = pal[Math.floor(Math.random() * pal.length)]; col[i * 3] = c[0]; col[i * 3 + 1] = c[1]; col[i * 3 + 2] = c[2];
      }
      geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
      geo.setAttribute('color', new THREE.BufferAttribute(col, 3));
      const pts = new THREE.Points(geo, new THREE.PointsMaterial({ size: .14, vertexColors: true, transparent: true, opacity: .7 }));
      scene.add(pts);

      /* Wireframe shapes */
      const mkMesh = (g, c, o) => { const m = new THREE.Mesh(g, new THREE.MeshBasicMaterial({ color: c, wireframe: true, transparent: true, opacity: o })); scene.add(m); return m };
      const ico = mkMesh(new THREE.IcosahedronGeometry(8, 1), 0xF59E0B, .045);
      const oct = mkMesh(new THREE.OctahedronGeometry(5, 0), 0x0D9488, .05);
      const tor = mkMesh(new THREE.TorusGeometry(13, .06, 8, 140), 0xF59E0B, .04);
      const tor2 = mkMesh(new THREE.TorusGeometry(9.5, .04, 6, 100), 0x4F46E5, .035);
      tor.rotation.x = Math.PI / 5; tor2.rotation.y = Math.PI / 3;

      let mx = 0, my = 0;
      document.addEventListener('mousemove', e => { mx = (e.clientX / innerWidth - .5) * 2; my = -(e.clientY / innerHeight - .5) * 2 }, { passive: true });

      let t = 0;
      (function anim() {
        requestAnimationFrame(anim); t += .004;
        for (let i = 0; i < N; i++) {
          pos[i * 3] += vel[i * 3]; pos[i * 3 + 1] += vel[i * 3 + 1]; pos[i * 3 + 2] += vel[i * 3 + 2];
          if (Math.abs(pos[i * 3]) > 28) vel[i * 3] *= -1;
          if (Math.abs(pos[i * 3 + 1]) > 23) vel[i * 3 + 1] *= -1;
          if (Math.abs(pos[i * 3 + 2]) > 14) vel[i * 3 + 2] *= -1;
        }
        geo.attributes.position.needsUpdate = true;
        ico.rotation.x = t * .06; ico.rotation.y = t * .09;
        oct.rotation.x = -t * .08; oct.rotation.z = t * .11;
        tor.rotation.z = t * .05; tor2.rotation.x = t * .07; tor2.rotation.z = -t * .05;
        camera.position.x += (mx * 2.8 - camera.position.x) * .025;
        camera.position.y += (my * 1.8 - camera.position.y) * .025;
        camera.lookAt(scene.position);
        renderer.render(scene, camera);
      })();
    })();

    /* ══════════════════ THEME ══════════════════ */
    function toggleTheme() {
      const h = document.documentElement;
      const gd = h.getAttribute('data-theme') === 'light';
      h.setAttribute('data-theme', gd ? 'dark' : 'light');
      document.getElementById('thIco').className = gd ? 'fas fa-sun' : 'fas fa-moon';
      document.getElementById('thTxt').textContent = gd ? 'Light Mode' : 'Dark Mode';
      setTimeout(drawCap, 60);
    }

    /* ══════════════════ CAROUSEL ══════════════════ */
    const LPN = 5, LPI = 4800;
    let lpI = 0, lpT = null;

    (function () {
      const nav = document.getElementById('lpNav');
      const prev = document.getElementById('lpPrev');
      const next = document.getElementById('lpNext');
      for (let i = 0; i < LPN; i++) {
        const d = document.createElement('button');
        d.className = 'lp-dot' + (i === 0 ? ' on' : '');
        d.setAttribute('aria-label', 'Slide ' + (i + 1));
        d.dataset.i = i;
        d.onclick = function () { lpGo(+this.dataset.i) };
        nav.insertBefore(d, next);
      }
      prev.onclick = () => lpGo(lpI - 1);
      next.onclick = () => lpGo(lpI + 1);
    })();

    function lpGo(n) {
      lpI = ((n % LPN) + LPN) % LPN;
      document.getElementById('lpTrack').style.transform = `translateX(-${lpI * 100}%)`;
      document.querySelectorAll('.lp-dot').forEach((d, i) => d.classList.toggle('on', i === lpI));
      lpRestart();
    }
    function lpRestart() {
      clearInterval(lpT);
      const f = document.getElementById('lpFill');
      f.style.transition = 'none'; f.style.width = '0%';
      void f.offsetWidth;
      f.style.transition = `width ${LPI}ms linear`; f.style.width = '100%';
      lpT = setInterval(() => lpGo(lpI + 1), LPI);
    }
    lpRestart();

    (function () {
      let sx = 0;
      const el = document.getElementById('lpanel');
      el.addEventListener('touchstart', e => { sx = e.touches[0].clientX }, { passive: true });
      el.addEventListener('touchend', e => { const dx = e.changedTouches[0].clientX - sx; if (Math.abs(dx) > 40) lpGo(lpI + (dx < 0 ? 1 : -1)) }, { passive: true });
    })();

    /* ══════════════════ CAPTCHA ══════════════════ */
    let capVal = '';

    function drawCap() {
      const canvas = document.getElementById('captchaImg');
      const ctx = canvas.getContext('2d');
      const W = canvas.width, H = canvas.height;
      const dark = document.documentElement.getAttribute('data-theme') === 'dark';

      ctx.clearRect(0, 0, W, H);

      /* Background */
      const bg = ctx.createLinearGradient(0, 0, W, 0);
      if (dark) { bg.addColorStop(0, '#1A1610'); bg.addColorStop(1, '#221E14') }
      else { bg.addColorStop(0, '#EEE8D8'); bg.addColorStop(1, '#E5DEC8') }
      ctx.fillStyle = bg; ctx.fillRect(0, 0, W, H);

      /* Dots */
      for (let i = 0; i < 180; i++) {
        ctx.beginPath(); ctx.arc(Math.random() * W, Math.random() * H, Math.random() * 1.2, 0, Math.PI * 2);
        ctx.fillStyle = dark ? 'rgba(255,255,255,.06)' : 'rgba(0,0,0,.05)'; ctx.fill();
      }

      /* Noise lines */
      for (let i = 0; i < 7; i++) {
        ctx.beginPath();
        ctx.moveTo(Math.random() * W, Math.random() * H);
        ctx.bezierCurveTo(Math.random() * W, Math.random() * H, Math.random() * W, Math.random() * H, Math.random() * W, Math.random() * H);
        ctx.strokeStyle = dark ? `rgba(${100 + Math.floor(Math.random() * 80)},${60 + Math.floor(Math.random() * 40)},0,.18)` : `rgba(${140 + Math.floor(Math.random() * 60)},${80 + Math.floor(Math.random() * 40)},0,.14)`;
        ctx.lineWidth = .7; ctx.stroke();
      }

      /* Generate code */
      const CH = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
      capVal = ''; for (let i = 0; i < 6; i++)capVal += CH[Math.floor(Math.random() * CH.length)];

      /* Draw chars */
      const clrs = ['#F59E0B', '#14B8A6', '#818CF8', '#F43F5E', '#10B981', '#FCD34D'];
      const fonts = ["'Syne'", "Georgia", "'DM Sans'", "Impact", "Garamond"];
      for (let i = 0; i < 6; i++) {
        ctx.save();
        ctx.translate(20 + i * 37, H / 2 + 4);
        ctx.rotate((Math.random() - .5) * .5);
        ctx.font = `bold ${20 + Math.floor(Math.random() * 8)}px ${fonts[Math.floor(Math.random() * fonts.length)]}`;
        ctx.fillStyle = clrs[i];
        ctx.shadowColor = dark ? 'rgba(0,0,0,.6)' : 'rgba(0,0,0,.18)'; ctx.shadowBlur = 3;
        ctx.fillText(capVal[i], 0, 0);
        ctx.restore();
      }

      /* Reset input */
      const inp = document.getElementById('fc');
      inp.value = ''; inp.classList.remove('ok', 'bad');
      setVH(document.getElementById('vhc'), '', '');
    }

    function refreshCap() {
      const btn = document.getElementById('capBtn');
      btn.classList.add('spin');
      setTimeout(() => btn.classList.remove('spin'), 420);
      drawCap();
    }

    drawCap();

    /* ══════════════════ ROLE ══════════════════ */
    let selRole = 'Administrator';
    function pickRole(btn, role) {
      document.querySelectorAll('.rtab').forEach(b => b.classList.remove('on'));
      btn.classList.add('on'); selRole = role;
      const ph = { Administrator: 'Enter admin username or email', Teacher: 'Enter staff ID or email', Student: 'Enter student ID or email', Parent: 'Enter parent mobile or email' };
      document.getElementById('fu').placeholder = ph[role] || 'Enter username or email';
    }

    /* ══════════════════ VALIDATION ══════════════════ */
    function setVH(el, type, html) {
      if (!type) { el.className = 'vhint'; el.innerHTML = ''; return }
      el.className = `vhint show ${type}`; el.innerHTML = html;
    }
    function vUser(el) {
      const v = el.value.trim(), vh = document.getElementById('vhu');
      if (!v) { el.classList.remove('ok', 'bad'); setVH(vh, '', ''); return }
      if (v.length >= 3) { el.classList.add('ok'); el.classList.remove('bad'); setVH(vh, 'ok', '<i class="fas fa-check-circle"></i> Looks good') }
      else { el.classList.add('bad'); el.classList.remove('ok'); setVH(vh, 'bad', '<i class="fas fa-times-circle"></i> Too short') }
    }
    function vPass(el) {
      const v = el.value, vh = document.getElementById('vhp');
      if (!v) { el.classList.remove('ok', 'bad'); setVH(vh, '', ''); return }
      if (v.length >= 6) { el.classList.add('ok'); el.classList.remove('bad'); setVH(vh, 'ok', '<i class="fas fa-check-circle"></i> Password entered') }
      else { el.classList.add('bad'); el.classList.remove('ok'); setVH(vh, 'bad', '<i class="fas fa-times-circle"></i> Min 6 characters') }
    }
    function vCap(el) {
      const v = el.value.toUpperCase().trim(), vh = document.getElementById('vhc');
      if (!v) { el.classList.remove('ok', 'bad'); setVH(vh, '', ''); return }
      if (v === capVal) { el.classList.add('ok'); el.classList.remove('bad'); setVH(vh, 'ok', '<i class="fas fa-check-circle"></i> Verified!') }
      else if (v.length >= capVal.length) { el.classList.add('bad'); el.classList.remove('ok'); setVH(vh, 'bad', '<i class="fas fa-times-circle"></i> Incorrect — refresh and retry') }
      else { el.classList.remove('ok', 'bad'); setVH(vh, '', '') }
    }

    /* ══════════════════ PASSWORD EYE ══════════════════ */
    let eyeOn = false;
    function toggleEye() {
      eyeOn = !eyeOn;
      document.getElementById('fp').type = eyeOn ? 'text' : 'password';
      document.getElementById('eyeIco').className = eyeOn ? 'fas fa-eye-slash' : 'fas fa-eye';
    }

    /* ══════════════════ BANNERS ══════════════════ */
    let eT = null, iT = null;
    function showErr(m) {
      clearTimeout(eT); hideInfo();
      document.getElementById('emsg').textContent = m;
      document.getElementById('ebar').classList.add('show');
      eT = setTimeout(() => document.getElementById('ebar').classList.remove('show'), 4500);
      const fc = document.getElementById('fcard');
      fc.style.animation = 'none'; void fc.offsetWidth; fc.style.animation = 'shake .38s ease';
    }
    function hideInfo() { document.getElementById('ibar').classList.remove('show') }
    function showInfo(m) {
      clearTimeout(iT); document.getElementById('ebar').classList.remove('show');
      document.getElementById('imsg').textContent = m;
      document.getElementById('ibar').classList.add('show');
      iT = setTimeout(() => document.getElementById('ibar').classList.remove('show'), 4500);
    }

    /* ══════════════════ FORGOT ══════════════════ */
    function forgotPw(e) {
      e.preventDefault();
      const u = document.getElementById('fu').value.trim();
      if (!u) { showErr('Enter your username or email first, then click Forgot Password.'); return }
      showInfo('Password reset link sent to: ' + u);
    }

    /* ══════════════════ LOGIN ══════════════════ */
    function doLogin() {
      const user = document.getElementById('fu').value.trim();
      const pass = document.getElementById('fp').value;
      const cap = document.getElementById('fc').value.toUpperCase().trim();
      const btn = document.getElementById('bsub');
      const txt = document.getElementById('btxt');
      document.getElementById('ebar').classList.remove('show');
      document.getElementById('ibar').classList.remove('show');

      if (!user || user.length < 3) { showErr('Please enter a valid username or email address.'); return }
      if (!pass || pass.length < 6) { showErr('Password must be at least 6 characters.'); return }
      if (cap !== capVal) { showErr('Incorrect security code. Please refresh and try again.'); refreshCap(); return }

      btn.disabled = true;
      txt.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>&nbsp;Signing in&hellip;';

      setTimeout(() => {
        btn.disabled = false;
        txt.innerHTML = '<i class="fas fa-sign-in-alt"></i><span>Sign In to GoSchool</span>';
        document.getElementById('sucSub').textContent = `Welcome back, ${selRole} · ${user}`;
        document.getElementById('sucOvl').classList.add('show');
        setTimeout(() => document.getElementById('sucOvl').classList.remove('show'), 3200);
      }, 1800);
    }

    /* ══════════════════ SSO ══════════════════ */
    function doSSO(p) {
      document.getElementById('sucSub').textContent = `Redirecting to ${p} authentication…`;
      document.getElementById('sucOvl').classList.add('show');
      setTimeout(() => document.getElementById('sucOvl').classList.remove('show'), 2600);
    }

    /* ══════════════════ ENTER KEY ══════════════════ */
    document.addEventListener('keydown', e => { if (e.key === 'Enter') doLogin() });
  </script>
</body>
</html>