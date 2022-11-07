<?php

namespace App\Entity;

class Artist
{

    /**
     * @param string $id
     * @param string $name
     * @param int $followers
     * @param array $genders
     * @param string $link
     * @param string $picture
     */

    public function __construct(public string $id,
                                public string $name,
                                public int    $followers,
                                public array  $genders,
                                public string $link,
                                public string $picture)
    {

    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * @param int $followers
     */
    public function setFollowers($followers)
    {
        $this->followers = $followers;
    }

    /**
     * @return array
     */
    public function getGenders()
    {
        return $this->genders;
    }

    /**
     * @param array $genders
     */
    public function setGenders($genders)
    {
        $this->genders = $genders;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function display(): string
    {
        return "<div class=\"col-lg-4 mb-5\">
                    <div class=\"card shadow-sm\">
                        <img class=\"bd-placeholder-img card-img-top\"
                             src=\"$this->picture\"
                             alt=\"Image de l'artiste $this->name \">
                        <div class=\"card-body\">
                            <h2>$this->name</h2>
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <div class=\"btn-group\">
                                    <a href=\"$this->link\">
                                        <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Spotify</button>
                                    </a>
                                    <a href=\"/artist.php/id=<?= $this->id ?>\" class=\"ms-1\">
                                        <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Voir plus...
                                        </button>
                                    </a>
                                </div>
                                <small class=\"text-muted\">$this->followers
                                    listeners</small>
                            </div>
                        </div>
                    </div>
        </div>";
    }
}