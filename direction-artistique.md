# Direction artistique — TODOAH

> Synthèse actionnable, construite à partir de `recherche-tdah.md`, `benchmark-gamification.md` et d'une recherche web ciblée (tendances UI 2025/2026, univers gamifiés, usages de Three.js/3D). Objectif : poser un cadre visuel avant maquettage, pas trancher toutes les décisions — les pistes 3D en particulier restent à choisir par toi.

---

## 1. Tendances UI 2025/2026 compatibles avec une attention fragile

Le mouvement de fond identifié dans la recherche 2026 va exactement dans le sens de ce qu'exige un profil TDAH : **la sobriété devient la norme professionnelle**, pas une concession. Plusieurs sources qualifient 2026 d'année où l'UI « troque le spectacle visuel contre la clarté cognitive ».

| Levier | Ce que dit la tendance 2025/2026 | Application directe pour TODOAH |
|---|---|---|
| **Palette sobre / apaisante** | Recul des interfaces chromatiquement chargées ; montée des modes « sensory-friendly » qui désaturent les couleurs vives et suppriment les autoplays | Palette de base neutre/désaturée (1-2 couleurs d'accent max), les couleurs vives réservées aux signaux qui comptent (succès, urgence) — pas au décor |
| **Dark mode + confort visuel** | Le dark mode pur (noir #000 + blanc pur) est déconseillé : il crée un contraste trop violent, source de fatigue visuelle et de « vibration » du texte pour les profils dyslexiques | Préférer gris foncé (~#121212) + texte blanc cassé (~#DEDEDE), jamais noir/blanc purs ; proposer clair ET sombre, au choix explicite de l'utilisateur |
| **Accessibilité contraste & police** | Contraste texte normal ≥ 4.5:1 (grand texte ≥ 3:1) ; polices « hyperlisibles » (Atkinson Hyperlegible, Lexend, Inter) ; corps de texte ≥ 16px, interligne ≥ 1.5 ; éviter l'italique | Choisir une police de la famille Inter/Lexend/Atkinson Hyperlegible en base ; jamais d'italique pour l'emphase, utiliser le gras |
| **Dyslexie-friendly** | Lignes de 60-75 caractères max, contraste « doux » plutôt que extrême, police OpenDyslexic/Lexend en option | Largeur de colonne de texte contrainte, jamais de pavés pleine largeur sur desktop |
| **Densité d'information réduite** | Retour à une navigation labellisée et explicite (fin des icônes cryptiques « clevers »), priorité au white space, hiérarchies visuelles simples | Une action principale par écran, labels textuels sur les icônes ambiguës, listes courtes plutôt que tableaux denses |
| **Motion contrôlé** | Le "Distraction-Free Mode" est annoncé comme aussi standard que le dark mode d'ici 2026 ; possibilité de couper parallax et animations clignotantes (accessibilité vestibulaire) | Toggle global « réduire les animations » respectant `prefers-reduced-motion` ; jamais d'auto-play, jamais de clignotement |
| **Micro-interactions informatives, non décoratives** | La gamification bruyante est remplacée par des micro-interactions calmes qui confirment une action sans la spectaculariser | Une animation = une information (tâche cochée, XP gagné) ; pas d'animation purement esthétique qui n'apporte rien |

**Point clé** : ces tendances confirment que ce que recherche-tdah.md demande (calme visuel, feedback concret, faible densité) n'est pas un compromis en dehors des standards actuels — c'est aligné avec où va le design d'interface en général en 2025/2026.

---

## 2. Références d'univers gamifiés

| Référence | Ce qui est transposable pour TODOAH | Ce qui est à éviter |
|---|---|---|
| **Habitica** (pixel-art RPG) | La progression visible (XP/niveaux), l'avatar qui évolue, le fait qu'un univers ludique entier motive l'usage quotidien | Univers visuellement chargé (inventaire, stats, boutique, guildes en simultané) → surcharge cognitive ; imagerie de combat/mort associée à l'échec, à proscrire totalement (cf. benchmark, §4) |
| **Duolingo** (flat design ludique) | Style vectoriel plat, formes arrondies sans angles vifs, une couleur d'accent saturée réservée au signal de succès sur un fond neutre, mascotte simple et attachante ; c'est un système facile à décliner en composants UI (boutons, cartes) | Le systématisme de la mascotte omniprésente peut devenir bruyant si dupliqué partout ; éviter le ton "urgence ludique" (notifications culpabilisantes autour du streak) |
| **Cozy games — Animal Crossing** | Absence totale de pression temporelle ou d'objectif imposé ; l'utilisateur avance à son rythme, la personnalisation (déco, avatar) est une fin en soi et nourrit l'autonomie (SDT) | Le rythme très libre d'Animal Crossing peut manquer de structure — TODOAH a besoin d'un minimum de guidage (rappels, priorités) qu'un cozy game pur n'a pas à gérer |
| **Cozy games — Stardew Valley** | Univers bienveillant, esthétique chaleureuse, sentiment de "ferme qui pousse" comme métaphore de progression cumulative | Peut devenir overwhelming en accéléré (gestion de multiples ressources/timers simultanés) — attention à ne pas reproduire cette surcharge de gestion parallèle |
| **A Short Hike / Spiritfarer (indé, cozy 3D low-poly)** | Référence directe et concrète pour un éventuel univers 3D : palette chaude, formes simples low-poly, éclairage doux, aucune urgence, exploration libre — exactement le registre visuel recherché si TODOAH va vers de la 3D | Nécessite un vrai savoir-faire 3D/éclairage pour ne pas tomber dans un rendu "asset store" cheap |
| **Finch / Forest** (déjà analysés dans benchmark-gamification.md) | Pas de mécanique de mort, personnalisation légère (déco, espèces d'arbres), feedback doux | — |
| **Apps de bien-être primées (Apple Design Award)** — ex. *Pawz* (respiration guidée pour enfants/adultes via animaux animés), *Evolve* (bien-être mental) | Preuve que le marché récompense un registre "illustration douce + micro-interactions calmes" plutôt que la richesse graphique ; ce sont des références directement dans la cible sensorielle de TODOAH | — |

---

## 3. Rôle possible de Three.js / 3D — 3 pistes

> **Décision (20/09/2026) : Piste A retenue** — avatar/compagnon 3D évolutif. Les pistes B et C restent documentées ci-dessous à titre de référence/repli, mais la conception (wireframe puis dev) part sur A.

### Piste A — Avatar/compagnon 3D évolutif ✅ retenue

- **Description** : un personnage ou une créature 3D (façon Finch/Habitica mais en volume) qui évolue visuellement selon la progression de l'utilisateur — nouvelle tenue, nouvel accessoire, posture plus "épanouie".
- **Références** : Ready Player Me (avatars 3D personnalisables, intégrables via Three.js/React Three Fiber) ; projets d'"avatar companion" Three.js qui restent en coin d'écran, suivent le curseur, réagissent aux actions sans occuper tout l'espace.
- **Avantages** : levier d'attachement émotionnel fort et non punitif (cf. benchmark §5) ; personnalisation = autonomie (SDT) ; un seul objet 3D à charger, donc raisonnable en coût technique et sensoriel si bien cadré (petit viewport, pas plein écran).
- **Risques** : si l'avatar est trop expressif/animé en permanence, il devient une distraction constante — contraire au besoin de calme visuel ; coût technique de l'animation squelettique (rigging, Mixamo) et de la maintenance d'assets 3D custom ; sur mobile bas de gamme, un rendu 3D permanent peut peser sur batterie/performance.

### Piste B — Monde / carte 3D à débloquer progressivement

- **Description** : une carte ou un petit monde 3D (îles, régions, jardin) qui se construit/s'éclaire/se peuple au fil des tâches et projets accomplis — la progression globale de l'utilisateur devient un paysage qui grandit plutôt qu'une jauge abstraite.
- **Références** : univers low-poly cozy (*A Short Hike*, *Spiritfarer*) pour le registre visuel ; démonstrations Three.js de "3D world in the browser" construit depuis Blender (Codrops) pour la faisabilité technique d'un petit monde navigable.
- **Avantages** : rend la progression tangible et mémorable (répond directement à la "time blindness" et au besoin de repères concrets, cf. recherche-tdah §4) ; se prête bien à une lecture "cozy game" non compétitive, à rythme choisi.
- **Risques** : c'est la piste la plus coûteuse techniquement (modélisation, éclairage, caméra, optimisation) ; risque réel de surcharge sensorielle si le monde devient visuellement dense (trop d'objets/décorations accumulés) ; nécessite une vraie direction artistique 3D pour ne pas paraître "générique/asset store" — investissement long avant un premier résultat satisfaisant.

### Piste C — Accents 3D ponctuels sur une UI 2D classique

- **Description** : garder une interface principalement 2D/flat (listes, cartes, dashboard) et n'introduire de la 3D que par petites touches — une icône ou un objet 3D isolé qui réagit légèrement au survol/à une complétion (ex. un trophée qui tourne doucement, un objet qui apparaît en volume lors d'un jalon).
- **Références** : usage de Spline pour des "UI scenes" 3D intégrées à des interfaces 2D par ailleurs sobres ; la tendance 2026 documentée est justement "la 3D qui ne cherche plus l'effet wow mais résout un problème de compréhension/navigation ponctuel".
- **Avantages** : coût technique et sensoriel le plus faible des trois pistes ; s'intègre facilement dans une DA calme sans jamais dominer l'écran ; dégradable facilement (peut être désactivé via le toggle "réduire les animations" sans casser l'expérience) ; la plus compatible nativement avec les recommandations de la section 1 (densité réduite, motion contrôlé).
- **Risques** : effet moins "wahou"/différenciant si l'ambition est de faire de la 3D un pilier de l'identité de marque ; à doser pour ne pas devenir un gadget décoratif sans fonction (cf. principe "une animation = une information", section 4).

**Remarque transverse** : quelle que soit la piste retenue, la littérature accessibilité est claire sur un risque commun à toute 3D interactive — dissonance vestibulaire (parallax, mouvements de caméra inattendus) pouvant provoquer inconfort/nausée chez des utilisateurs sensibles, et coût batterie/performance sur mobile. Toute option 3D doit donc être **skippable/désactivable** et dégrader proprement vers une version statique/2D.

---

## 4. Principes de DA à retenir pour TODOAH

Ces principes croisent explicitement les constats de `recherche-tdah.md` et `benchmark-gamification.md` avec les tendances ci-dessus.

1. **Calme visuel par défaut, intensité en option** — palette neutre/désaturée de base ; les couleurs vives sont un signal rare (succès, urgence réelle), jamais un fond décoratif. Répond directement à la paralysie décisionnelle et à la fatigue de charge cognitive (recherche-tdah §3).
2. **Une information = une animation, jamais de décor pur** — chaque micro-interaction doit confirmer une action (tâche cochée, XP gagné) ; aucune animation "juste jolie" qui capte l'attention sans la servir. Corollaire direct du besoin de feedback immédiat mais non intrusif.
3. **Feedback immédiat et concret, jamais culpabilisant** — reprendre le réflexe des micro-célébrations (Duolingo, Finch) pour chaque petite étape terminée, mais bannir tout visuel de pénalité, de perte ou de "mort" pour une tâche manquée (cf. RSD, recherche-tdah §3 et benchmark §4). Un retard se représente en ton neutre ou encourageant — jamais en rouge alarmant, jamais en compteur qui "casse".
4. **Progression toujours visible et jamais remise à zéro brutalement** — privilégier des jauges/représentations qui se dégradent et se récupèrent progressivement (type Momentum Score de Habitify) plutôt que des streaks binaires ou des barres de vie.
5. **Densité d'information faible, une action principale par écran** — listes courtes, hiérarchie visuelle claire, labels explicites plutôt qu'icônes cryptiques ; réduit le risque de "submersion" identifié en recherche-tdah §3.
6. **Motion et 3D toujours désactivables** — respecter `prefers-reduced-motion`, offrir un mode "distraction-free", et concevoir toute composante 3D (quelle que soit la piste choisie en section 3) pour qu'elle se dégrade proprement en statique.
7. **Personnalisation comme levier d'autonomie, pas comme système à gérer** — l'avatar/l'univers évolutif nourrit le besoin d'autonomie (SDT) tant qu'il reste secondaire et non contraignant ; ne jamais transformer la personnalisation elle-même en corvée de gestion (inventaire complexe, multiples monnaies).
8. **Accessibilité typographique non négociable** — police hyperlisible (famille Inter/Lexend/Atkinson Hyperlegible), corps ≥ 16px, interligne ≥ 1.5, jamais d'italique pour l'emphase, contraste ≥ 4.5:1 sans jamais aller au noir/blanc pur.
9. **Ton bienveillant systématique dans les visuels d'échec ou de retard** — un jalon manqué se présente comme une reprogrammation proposée, pas comme un échec affiché ; aucune mécanique sociale qui ferait porter la faute d'un individu à un groupe.

---

## 5. Sources

- [UX/UI design trends for 2026: calm interfaces, transparent AI and the end of visual theatrics — Envato](https://elements.envato.com/learn/ux-ui-design-trends)
- [12 UI/UX Design Trends That Will Dominate 2026 — Index.dev](https://www.index.dev/blog/ui-ux-design-trends)
- [The Principles of Neurodivergent UX Design Every Designer Should Know — AccessibilityChecker.org](https://www.accessibilitychecker.org/blog/neurodivergent-ux-design/)
- [UI/UX and ADHD: Designing for Focus in a Distracted World — DesignMonks](https://www.designmonks.co/blog/ui-ux-and-adhd)
- [7 Most Accessible Fonts for Websites (2026 Guide) — WebAbility](https://www.webability.io/blog/most-accessible-fonts)
- [How To Design For Users With Dyslexia — Smart Interface Design Patterns](https://smart-interface-design-patterns.com/articles/dyslexia-design/)
- [Website Design Trends for Dyslexia and ADHD — Verndale](https://www.verndale.com/insights/accessibility/website-design-trends-for-dyslexia-and-adhd)
- [How to Make Your UI Accessible: A Practical Checklist for 2026 — Muzli](https://muz.li/blog/how-to-make-your-ui-accessible-a-practical-checklist-for-2026/)
- [Cozy game — Wikipedia](https://en.wikipedia.org/wiki/Cozy_game)
- [What makes video games like Stardew Valley and Animal Crossing cozy? — Washington Post](https://www.washingtonpost.com/video-games/2023/01/18/cozy-games-unpacking-stardew-valley-animal-crossing/)
- [A Short Hike — Wikipedia](https://en.wikipedia.org/wiki/A_Short_Hike)
- [The Evolution of Cozy Game Graphics: From Pixel Art to High-Definition — SDLC Corp](https://sdlccorp.com/post/the-evolution-of-cozy-game-graphics-from-pixel-art-to-high-definition/)
- [Duolingo: A Brand Breakdown — Canny Creative](https://www.canny-creative.com/brand-breakdown/brand/duolingo-a-brand-breakdown/)
- [Duolingo Design System — Colors, Typography & Tokens — Oh My Design](https://oh-my-design.kr/design-systems/duolingo)
- [GitHub — nirholas/3d-avatar-companion (Three.js avatar mascot)](https://github.com/nirholas/3d-avatar-companion)
- [Ready Player — Models for Three.js](https://threejsresources.com/tool/ready-player)
- [Build a 3D Avatar Builder with Three.js and React — Wawa Sensei](https://wawasensei.dev/tuto/3d-avatar-builder-threejs-course)
- [Building a Fully-Featured 3D World in the Browser with Blender and Three.js — Codrops](https://tympanus.net/codrops/2025/04/08/3d-world-in-the-browser-with-blender-and-three-js/)
- [Best Three.js Websites 2026: 8 Sites + Techniques — Utsubo](https://www.utsubo.com/blog/best-threejs-websites-2026)
- [3D UI Design — Spline](https://spline.design/solutions/ui-design)
- [Spline.design in 2026: The Complete Guide to Building Immersive 3D Web Experiences Without Code — Medium](https://medium.com/@abhinav.dobhal/spline-design-in-2026-the-complete-guide-to-building-immersive-3d-web-experiences-without-code-097f475b3951)
- [Web Accessibility for Vestibular Disabilities — UX Planet](https://uxplanet.org/web-accessibility-for-vestibular-disabilities-919a78d7b0b1)
- [Designing Safer Web Animation For Motion Sensitivity — A List Apart](https://alistapart.com/article/designing-safer-web-animation-for-motion-sensitivity/)
- [What is Cybersickness in Virtual Reality? — Interaction Design Foundation](https://ixdf.org/literature/topics/cybersickness-in-virtual-reality)
- [Meet the 2025 Apple Design Award Winners — App Store](https://apps.apple.com/us/story/id1808994124)
- [2025 winners and finalists — Apple Design Awards](https://developer.apple.com/design/awards/2025/)

---

*Document de synthèse à usage interne pour la conception de l'application TODOAH — rédigé le 20/09/2026.*
