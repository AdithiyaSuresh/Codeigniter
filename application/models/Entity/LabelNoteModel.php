<?php

namespace Entity;

/**
 * LabelNoteModel Model
 *
 * @Entity
 * @Table(name="label_note_model")
 * 
 */
class LabelNoteModel
{

	/**
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="string", length=100, unique=false, nullable=false)
	 */
    protected $title;
    /**
	 * @Column(type="string", length=100, unique=false, nullable=false)
	 */
	protected $noteContent;

    /**
	 * @Column(type="string", length=100, unique=false, nullable=false)
	 */
	protected $date;



	/**
	 * @ManyToOne(targetEntity="LabelModel")
	 * @JoinColumn(name="label_model", referencedColumnName="id")
	 */
	protected $labelmodel;

	/**
	 * Assign the doc_labeled_notes to a docLabel
	 *
	 * @param	Entity\LabelModel	$labelmodel
	 * @return	void
	 */
	public function setLabelModel(LabelModel $labelmodel)
	{
		$this->labelmodel = $labelmodel;

		// The association must be defined in both directions
		if ( ! $labelmodel->getLabel_note_model()->contains($this))
		{
			$labelmodel->addLabel_note_model($this);
		}
	}


	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function setTakeANote($noteContent)
	{
		$this->noteContent = $noteContent;
		return $this;
	}
	public function setDateAndTime($date)
	{
		$this->date = $date;
		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getTakeANote()
	{
		return $this->noteContent;
	}

	public function getDateAndTime()
	{
		return $this->date;
	}

	/**
	 * Get labelmodel
	 *
	 * @return Entity\LabelModel
	 */
	public function getDocLabel()
	{
		return $this->labelmodel;
	}

}