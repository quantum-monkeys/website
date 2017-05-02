<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\NewsBundle\Entity;

use AppBundle\Entity\Person;
use Eko\FeedBundle\Item\Writer\RoutedItemInterface;
use Sonata\NewsBundle\Entity\BasePost as BasePost;

/**
 * This file has been generated by the Sonata EasyExtends bundle.
 *
 * @link https://sonata-project.org/bundles/easy-extends
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Post extends BasePost implements RoutedItemInterface
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var Person $author
     */
    protected $author;

    /**
     * @var string
     */
    protected $lang;

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * 
     * @return Post
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * This method returns feed item title.
     *
     * @return string
     */
    public function getFeedItemTitle()
    {
        return $this->getTitle();
    }

    /**
     * This method returns feed item description (or content).
     *
     * @return string
     */
    public function getFeedItemDescription()
    {
        return $this->getAbstract();
    }

    /**
     * This method returns item publication date.
     *
     * @return \DateTime
     */
    public function getFeedItemPubDate()
    {
        return $this->getPublicationDateStart();
    }

    /**
     * This method returns the name of the route.
     *
     * @return string
     */
    public function getFeedItemRouteName()
    {
        return 'blog_view';
    }

    /**
     * This method returns the parameters for the route.
     *
     * @return array
     */
    public function getFeedItemRouteParameters()
    {
        return [
            'permalink' => $this->generatePermalink()
        ];
    }

    /**
     * This method returns the anchor to be appended on this item's url.
     *
     * @return string The anchor, without the "#"
     */
    public function getFeedItemUrlAnchor()
    {
        return '';
    }

    public function generatePermalink()
    {
        $permalinkElements = [
            $this->getYear(),
            $this->getMonth(),
            $this->getDay(),
            $this->getSlug()
        ];

        return implode('/', $permalinkElements);
    }
}
