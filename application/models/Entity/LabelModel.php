<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * LabelModel Model
 *
 * @Entity
 * @Table(name="label_model")
 *
 */
class LabelModel
{

    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @userId
     * @Column(type="integer",length=32, nullable=false)
     * 
     */
    protected $userId;
    /**
     * @Column(type="string", length=32, unique=true, nullable=false)
     */
    protected $labelname;

    /**
     * @OneToMany(targetEntity="LabelNoteModel", mappedBy="label_model")
     */
    protected $label_note_model;

    /**
     * Initialize any collection properties as ArrayCollections
     *
     * http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#initializing-collections
     *
     */
    public function __construct()
    {
        $this->label_note_model = new ArrayCollection;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set labelname
     *
     * @param string $labelname
     * @return LabelModel
     */
    public function setLabelName($labelname)
    {
        $this->labelname = $labelname;
        return $this;
    }

    /**
     * Get labelname
     *
     * @return string
     */
    public function getLabelName()
    {
        return $this->labelname;
    }

    /**
     * Add label_note_model
     *
     * @param Entity\LabelNoteModel $label_note_model
     * @return LabelModel
     */
    public function addLabel_note_model(\Entity\LabelNoteModel $label_note_model)
    {
        $this->label_note_model[] = $label_note_model;
        return $this;
    }

    /**
     * Get label_note_model
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getLabel_note_model()
    {
        return $this->label_note_model;
    }

}