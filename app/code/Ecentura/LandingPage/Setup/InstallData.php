<?php

namespace Ecentura\LandingPage\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;


    public function __construct(
        BlockFactory $blockFactory,
        EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->blockFactory = $blockFactory;

    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $banner = '
        <div class="ad_content_banner">
    <div class="main-banner">
        <div class="main-category">
            <div class="text"><h2>Katoenen tassen bedrukken</h2>
                <ul>
                    <li>Al vanaf <strong>10</strong> stuks voor <strong>€ 45<span>,67</span></strong></li>
                    <li>Leverbaar binnen <strong><span class="delivery-days">4</span> werkdagen</strong></li>
                </ul>
                <a href="https://www.pinkcube.nl/tassen-bedrukken/katoenen-tassen.html" class="btn btn-success btn-xl">Katoenen
                    tassen</a></div>
            <img src="https://www.pinkcube.nl/media/homepage/katoenen-tassen.png" title="Katoenen tassen bedrukken">
        </div>
        <div class="mhmr">

            <div class="head">
                <a href="https://www.pinkcube.nl/moeiteloos-het-mooiste-resultaat"
                   title="Moeiteloos het mooiste resultaat" target="_blank">Moeiteloos het <strong>mooiste
                        resultaat</strong></a>
            </div>

            <div class="row usp">
                <span class="usp-head">Gemakkelijk <strong>online bestellen</strong></span>
            </div>

            <div class="row usp">
                <span class="usp-head"><strong>Gratis</strong> digitaal ontwerp</span>
            </div>

            <div class="row usp">
                <span class="usp-head">Snelle levering en service</span>
            </div>

        </div>
    </div>
    <div class="row main-subcats">
        <div class="ad_related_pro">
            <div class="raleted_pro_general">
                <div class="raleted_pro_detailds"><a
                            href="https://www.pinkcube.nl/tassen-bedrukken/opvouwbare-boodschappentasjes.html"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/o/p/opvouwbare-boodschappentas-met-unieke-opvouwfunctie-navy-532c-deco.png"
                                    alt="Opvouwbare boodschappentasjes bedrukken????" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Opvouwbare boodschappentasjes</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 25 stuks</li> </ul> </span></div>
                        </div>
                    </a>
                </div>
                <div class="raleted_pro_detailds"><a
                            href="https://www.pinkcube.nl/tassen-bedrukken/opvouwbare-boodschappentasjes.html"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/o/p/opvouwbare-boodschappentas-met-unieke-opvouwfunctie-navy-532c-deco.png"
                                    alt="Opvouwbare boodschappentasjes bedrukken????" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Opvouwbare boodschappentasjes</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 25 stuks</li> </ul> </span></div>
                        </div>
                    </a>
                </div>
                <div class="raleted_pro_detailds"><a
                            href="https://www.pinkcube.nl/tassen-bedrukken/opvouwbare-boodschappentasjes.html"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/o/p/opvouwbare-boodschappentas-met-unieke-opvouwfunctie-navy-532c-deco.png"
                                    alt="Opvouwbare boodschappentasjes bedrukken????" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Opvouwbare boodschappentasjes</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 25 stuks</li> </ul> </span></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>';
        $content = '
<div class="content-below" >
    <div class="container">
        <div class="view-hometext-mobile">
            <a href="javascript:;">Bekijk meer info over tassen</a>
        </div>

        <div class="hometext row">
            <div class="col-xs-12">
                <h2>Tas bedrukken met logo</h2>
                <p dir="ltr">Bedrukte tassen zijn het perfecte weggevertje. Denk aan uw collega’s, beursbezoekers of misschien wel aan relaties. Een tas met opdruk biedt namelijk de mogelijkheid om een specifieke USP te uiten in de vorm van een quote of misschien wel in de vorm van een spectaculaire afbeelding. Ook kunt u eenvoudig de tas laten bedrukken met logo. Doordat bijvoorbeeld uw collega’s op pad gaan met deze hippe, herbruikbare tassen, bent u zichtbaar buiten de deur. Dat komt de naamsbekendheid gegarandeerd ten goede.</p>
                <p dir="ltr">Ook wanneer u een zakelijke doelgroep heeft, is een bedrukte tas de juiste keuze. Bij Pinkcube hebben we een uitgebreid assortiment waar u ook bedrukte trolleys of bedrukte toilettassen kunt krijgen. Daarnaast kunt u rugzakken bedrukken met logo, <a title="Laptoptas bedrukken" href="https://www.pinkcube.nl/tassen-bedrukken/laptoptassen.html" target="_blank">laptoptas bedrukken</a> of een reistas bedrukken. Gaat u naar een beurs? Kies dan voor luxe papieren tassen bedrukken, katoenen zakjes bedrukken of een katoenen tas met opdruk. Genoeg keuze voor iedereen!</p><h2>Laatste trends bedrukte tassen</h2>
                <p dir="ltr">Wilt u graag tassen drukken, maar heeft u nog niet helemaal duidelijk voor ogen wat u wilt? Bij ons kunt u een tas laten bedrukken vanaf 5 stuks! Binnen onze collectie treft u niet alleen diverse modellen en formaten. Bij Pinkcube kunt u namelijk ook terecht voor tassen van verschillende structuren, stoffen en materialen.</p>
                <ul>
                    <li>Polyester tasjes</li>
                    <li>Katoenen tas</li>
                    <li>Linnen tas</li>
                    <li>Jute tas</li>
                    <li>Papieren tassen</li>
                    <li>Stoffen tas</li>
                    <li>Vilten tas</li>
                </ul>
                <p>Zo bieden wij u de gelegenheid tot eindeloos combineren om uiteindelijk de perfecte tas voor uzelf, uw onderneming of evenement te kiezen. Ons assortiment wordt wekelijks aangevuld met de laatste trends en ontwikkelingen. Een van deze trends zijn de duurzame alternatieven. Bedrukte jute tassen en tassen van gerecycled materiaal of tasjes van kurk zijn helemaal hip. We hebben verschillende varianten die aansluiten op deze trend. Daarnaast zien we in de opdruk vaak goud/zilver of andere opvallende kleuren terugkomen. Op straat komen de meest unieke quotes of uitspraken voorbij. Het is een absolute musthave om met een herbruikbare tas de deur uit te gaan!</p>
                <h2>Tassen met opdruk</h2>
                <p dir="ltr">Het samenstellen van uw tas is nog nooit zo gemakkelijk geweest. Want een opdracht plaatsen bij Pinkcube gaat eenvoudig en snel. Om te beginnen maakt u een keuze uit de beschikbare modellen tassen. Kiest u voor een bedrukte rugzak, een bedrukte shopper of toch voor een bedrukte tote bag. Wellicht heeft u voorkeur voor lange hengsels of korte hengsels. <strong>De keuze is geheel aan u.</strong> Vervolgens maakt u een keuze betreffende de kleur en het aantal bedrukte tassen die u wilt bestellen. Optioneel kunt u uw eigen logo uploaden, welke op de tas zal komen te staan. Natuurlijk kunt u ook een alternatief ontwerp of afbeelding uploaden, al dan niet in full colour print. Heeft u hulp nodig van een creatief brein? Dan staan onze grafische vormgevers voor u klaar. Ze helpen u graag de juiste tas met logo bedrukken. U kunt eenvoudig uw prijs berekenen op onze website en een geheel vrijblijvende offerte aanvragen. Deze versturen wij middels een e-mail naar u toe. Al onze prijzen zijn all-in: wij berekenen geen instel-, verzend-, behandelings- of andere verborgen kosten. Heeft u vragen? Onze klantenservice staat u graag te woord.</p>
                <p dir="ltr">Bedrukte tassen is onze specialiteit. Dit maakt onze diensten hoogwaardig en betrouwbaar. Kwaliteit en klanttevredenheid staan bij ons voorop. Het is daarom dat Pinkcube streeft naar tassen bedrukken in de hoogste kwaliteit. Wij weten immers hoe belangrijk de kwaliteit van uw promotiemateriaal is! Plaatst u bij ons een bestelling, dan bent u zeker van een resultaat zoals u het verlangt. Want wij zijn pas tevreden, wanneer u dat bent.</p>
                <h2>Draagtas met opdruk</h2>
                <p dir="ltr">Bedrukte tasjes met eigen logo, precies zoals u het in gedachten heeft? Uw eigen ontwerp, speciaal en op maat voor uw bedrijf, beurs of productpresentatie? Laat dat over aan Pinkcube! Wij, als specialisten in het tassen bedrukken, bieden een uitgebreide collectie aan kwalitatieve en fraaie tassen, bestaande uit meer dan 160 verschillende modellen. Omdat onze tassen verkrijgbaar zijn in een talrijk aan formaten, soorten en kleuren, vindt u altijd waar u naar op zoek bent. Bij ons kunt u op een eenvoudige en voordelige wijze keuze maken uit een groot aanbod van unieke modellen. Zo kunt u bij ons terecht voor <a title="Draagtassen bedrukken" href="https://www.pinkcube.nl/tassen-bedrukken/draagtassen-bedrukken.html" target="_blank">draagtassen bedrukken</a>, goodiebags bedrukken of big shoppers bedrukken, maar ook polyester rugzakken bedrukken, plunjezakken bedrukken, heuptassen bedrukken en sporttassen bedrukken behoren tot ons assortiment. Ook goedkoop tassen bedrukken behoort tot de mogelijkheden. Laat u verrassen door een breed scala aan keuzes die u doet verzekeren van een ontwerp en vormgeving zoals u dat wenst!</p>
                <p dir="ltr">Is er een bestelling bij Pinkcube geplaatst, dan wordt deze altijd zo snel mogelijk geleverd. Wanneer u een snelle deadline heeft, kunt u deze wens kenbaar maken bij onze klantenservice. Wij streven er altijd naar uw deadline te halen zodat u zo snel mogelijk kunt profiteren van uw op maat gemaakte bedrukte tassen.</p>            </div>
        </div>
        <div class="row hidden-xs">
            <div class="faq-store col-xs-12" itemscope="" itemtype="https://schema.org/FAQPage">
                <h2>Veelgestelde vragen</h2>

                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 itemprop="name">Wat houdt grammage in bij de tassen?</h3>
                    <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><span style="background-color: transparent;">Het gewicht van het materiaal, uitgedrukt in het aantal gram per vierkante meter.&nbsp; Dit is een indicatie van de kwaliteit van de tas. Een lichte kwaliteit heeft doorgaans minder draagvermogen dan een zware kwaliteit.</span></p>
                        </div>
                    </div>
                </div>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 itemprop="name">Waar let u op als u een tas koopt?</h3>
                    <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><span style="background-color: transparent;">De functie van de tas speelt natuurlijk een grote rol. Is het de bedoeling dat de tas meerdere keren te gebruiken is? Dan is een katoenen tas met stevige hengsels erg handig. Bij eenmalig gebruik kunt u voor een goedkopere variant tas kiezen, zoals een papieren tas.&nbsp;&nbsp;</span></p><p>&nbsp;</p><p><span style="background-color: transparent;">Wanneer u een nieuwe tas uitzoekt, is het handig om op de volgende punten te letten:&nbsp;</span></p><p><span style="background-color: transparent;">Het type hengsel, de grootte, het materiaal en of het voor éénmalig gebruik is of voor een herbruikbare tas. </span><a href="https://www.pinkcube.nl/tassen-bedrukken" rel="noopener noreferrer" target="_blank" style="background-color: transparent; color: rgb(245, 48, 201);">Bekijk hier al onze tassen</a><span style="background-color: transparent; color: rgb(245, 48, 201);">. </span></p>
                        </div>
                    </div>
                </div>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 itemprop="name">Hoeveel gewicht kan er in de tas?</h3>
                    <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><span style="background-color: transparent;">Wat er precies aan massa in de tas kan, is wisselend en ligt aan verschillende factoren. Dit hangt vooral af van het materiaal van de tas.&nbsp;</span></p><p>&nbsp;</p><p><span style="background-color: transparent;">Voor de volgende twee katoenen draagtassen, onze bestsellers, is er een draagtest gedaan om dit exact aan te kunnen geven:</span></p><p><a href="https://www.pinkcube.nl/tassen-bedrukken/schoudertassen-bedrukken/carolina-katoenen-draagtas.html" rel="noopener noreferrer" target="_blank" style="background-color: transparent; color: rgb(17, 85, 204);">Lichte kwaliteit: </a><span style="background-color: transparent;">&nbsp;Getest draagvermogen 12,5 kg.&nbsp;</span></p><p><a href="https://www.pinkcube.nl/tassen-bedrukken/schoudertassen-bedrukken/madras-katoenen-tas.html" rel="noopener noreferrer" target="_blank" style="background-color: transparent; color: rgb(17, 85, 204);">Zware kwaliteit:</a><span style="background-color: transparent;"> Getest draagvermogen 20 kg.&nbsp;</span></p><p>&nbsp;</p><p><span style="background-color: transparent;">Heeft u een vraag over een ander model? Neem dan contact met ons op. Dan kijken we samen naar het draagvermogen van de gewenste tas. </span></p><p><br></p><p><br></p>
                        </div>
                    </div>
                </div>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 itemprop="name">Welke druktechniek wordt gebruikt op de tassen?</h3>
                    <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><span style="background-color: transparent;">Meestal maken we gebruik van een zeefdruk. Daarmee kunnen we de tas voorzien van maximaal vier kleuren. Een andere methode die we gebruiken bij het bedrukken van tassen is een transferdruk, daarmee kunnen we de tas ook bedrukken met een full color design. </span></p>
                        </div>
                    </div>
                </div>                </div>
        </div>
    </div>
</div>'
        ;
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'is_landing', [
                'type' => 'int',
                'label' => 'Landing Page',
                'input' => 'select',
                'source' => Boolean::class,
                'sort_order' => 2,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]

        );


        $cmsBlockData = [
            'title' => 'Landing Page',
            'identifier' => 'Landing-page',
            'content' => $banner.'<p>{{block class="Ecentura\LandingPage\Block\Landing\Custom"  name ="landing-page" template="Ecentura_LandingPage::custom.phtml"}} </p>'.$content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];
        $this->blockFactory->create()->setData($cmsBlockData)->save();
    }
}
